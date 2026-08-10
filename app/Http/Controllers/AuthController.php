<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Google\Client as GoogleClient;
use App\Resources\UserResource;
use App\Services\UserService;
use App\Models\User;

class AuthController extends Controller
{
    //FUNÇÃO DE LOGIN
    public function login(Request $request){
        //TENTAR EFETUAR LOGIN
        try {
            //VERIFICAR SE DADOS RECEBIDOS NÃO ESTÃO VAZIO
            if(!empty($request->all())){
                $token = null;
                //CASOS DE TIPOS DE LOGIN
                switch ($request->type) {
                    case 'google':
                        $user = $this->google($request);
                        break;
                    default:
                        $user = $this->platform($request);
                        break;
                }
                //VERIFICAR SE USUARIO FOI RECEBIDO
                if (empty($user)) throw new \Exception('Falha ao autenticar: usuário inválido ou não retornado pelas funções de login');
                //GERAR TOKEN JWT
                $token = JWTAuth::fromUser($user);
                //ADICIONAR TOKEN AOS DADOS DO USUARIO
                $user = UserResource::make($user);
                return response()->json(['user' => $user, 'token' => $token], 200);
            }
        }catch(\Exception $e) {
            //CAPTURAR ERRO E ENVIAR PARA O LOG
            Log::channel('auth')->error("[Erro de autenticação][Usuario][Auth]", ['[message]' => $e->getMessage(), '[error]' => $e->getTraceAsString()]);
            //REDIRECIONAR PARA O FORMULÁRIO COM A MENSAGEM DE ERRO
            return response()->json(['message' => 'Houve um erro ao efetura login. Tente novamente mais tarde!'], 500);
        }
    }

    //FUNÇÃO DE LOGIN NA PLATAFORMA
    public function platform(Request $request){
        try {
            //REQUEST CREDENCIAIS 
            $credentials = $request->only('user', 'password');
            //INICIALIZAR USUARIO
            $user = null;
            //VERIFICAR TIPO DE AUTENTICAÇÃO (EMAIL OU USERNAME)
            if (filter_var($credentials['user'], FILTER_VALIDATE_EMAIL)) {
                //TENTAR AUTENTICAR PELO EMAIL
                $credentials = ['email' => $credentials['user'], 'password' => $credentials['password']]; 
                $user = User::with('player','manager')->where('email', $credentials['email'])->first();
            } else {
                //TENTAR AUTENTICAR PELO USER NAME
                $credentials = ['user_name' => $credentials['user'], 'password' => $credentials['password']];
                $user = User::with('player','manager','config','level', 'participants','achievements')->where('user_name', $credentials['user_name'])->first();
            }
            //VERIFICAR SE CREDENCIAIS DO USUARIO SÃO VALIDAS
            if (!JWTAuth::attempt($credentials)) {
                throw new \Exception('E-mail/Usuario ou senha estão incorretos');
            }
            //RETORNAR USUARIO AUTENTICADO
            return $user;
        } catch (\Exception $th) {
            throw $th;
        }
    }

    //FUNÇÃO DE LOGIN NO GOOGLE
    public function google(Request $request){
        //TENTAR EFETUAR LOGIN
        try {
            $token = $request->id_token ?? null;
            $httpClient = new \GuzzleHttp\Client([
                "verify" => false
            ]);//(TEMP)***
            //VERIFICAR TOKEN DE AUTENTICAÇÃO COM O GOOGLE
            $googleClient = new GoogleClient(['client_id' => config('services.google.client_id')]);
            $googleClient->setHttpClient($httpClient);//(TEMP)***
            $payload = $googleClient->verifyIdToken($token);
            if (!$payload) {
                //REGISTRAR ERRO DE LOGIN
                Log::channel('auth')->error("[Erro de Authenticação][Google]", [
                    "message" => "Token inválido",
                    'token' => substr($token, 0, 50) . '...',
                    'client_id' => config('services.google.client_id')
                ]);
                throw new \Exception('Token Invalido');
            }
            //BUSCAR USUARIO 
            $user = User::with('player','manager','config','level','participants','achievements')->where('email', $payload['email'])->first();
            if(empty($user)){
                $userService = new UserService();
                $user = $userService->create($payload);
            }
            return $user;
        } catch (\Exception $th) {
            throw $th;
        }
    }

    //FUNÇÃO DE LOGOUT
    public function logout(Request $request){
        try {
            //VERIFICAR SE UUID DO USUARIO FOI ENVIADO
            if(!empty($request->all()) && isset($request['uuid'])){
                //INVALIDAR TOKEN
                JWTAuth::invalidate(JWTAuth::getToken());
                //RETORNAR MENSAGEM DE LOGOUT
                return response()->json(['user' => null],200);
            }else{
                //RETORNAR MENSAGEM DE LOGOUT
                return response()->json(['message' => 'Houve um erro ao efetura logout. Usuario não especificado!'], 500);
            }
        }catch(\Exception $e) {
            //CAPTURAR ERRO E ENVIAR PARA O LOG
            Log::channel('auth')->error("[Erro de Logout][Usuario][Auth]", ['[message]' => $e->getMessage(), '[error]' => $e->getTraceAsString()]);
            //REDIRECIONAR PARA O FORMULÁRIO COM A MENSAGEM DE ERRO
            return response()->json(['message' => 'Houve um erro ao efetura logout. Tente novamente mais tarde!'], 500);
        }
    }

    //FUNÇÃO DE RENOVAÇÃO TOKEN JWT
    public function refresh(Request $request)
    {
        try {
            // Tenta renovar o token atual
            $newToken = JWTAuth::parseToken()->refresh();

            return response()->json([
                'token' => $newToken
            ], 200);

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['message' => 'Token expirado, faça login novamente.'], 401);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['message' => 'Token inválido.'], 401);

        } catch (\Exception $e) {
            Log::channel('auth')->error("[Erro ao renovar token]", [
                '[message]' => $e->getMessage()
            ]);
            return response()->json(['message' => 'Não foi possível renovar o token.'], 500);
        }
    }

    //FUNÇÃO DE VERIFICAÇÃO DE TOKEN
    public function me(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json(['message' => 'Usuário não encontrado.'], 404);
            }

            return response()->json(['user' => UserResource::make($user)], 200);

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['message' => 'Token expirado.'], 401);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['message' => 'Token inválido.'], 401);
        }
    }
}
