<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Google\Client as GoogleClient;
use App\Resources\UserResource;
use App\Services\UserService;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * AUTH - LOGIN DE USUARIO.
     *
     * @param Array: Dados de Login (email, password, google token)
     * @return Array: App\Models\User, SanctumToken
     */
    public function login(Request $request){
        try {
            if(!empty($request->all())){
                $token = null;
                switch ($request->type) {
                    case 'google':
                        $user = $this->google($request);
                        break;
                    default:
                        $user = $this->platform($request);
                        break;
                }
                if (empty($user)) throw new \Exception('Falha ao autenticar: usuário inválido ou não retornado pelas funções de login');
                $token = $user->createToken($user->uuid)->plainTextToken;
                $user = UserResource::make($user);
                return response()->json(['user' => $user, 'token' => $token], 200);
            }
        }catch(\Exception $e) {
            Log::channel('auth')->error("[Erro de autenticação][Usuario][Auth]", ['[message]' => $e->getMessage(), '[error]' => $e->getTraceAsString()]);
            return response()->json(['message' => 'Houve um erro ao efetura login. Tente novamente mais tarde!'], 500);
        }
    }

    /**
    * AUTH - LOGIN PELA PLATAFORMA
    *
    * @param Array: Dados de Login (email, password)
    * @return User: App\Models\User;
    */
    public function platform(Request $request){
        try {
            $credentials = $request->only('user', 'password');
            $user = null;
            $relations = ['player','manager','config','level', 'participants','achievements'];
            $user = User::with($relations)
                        ->where('email', $credentials['user'])
                        ->orWhere('user_name', $credentials['user'])
                        ->first();
            if (empty($user) || !Hash::check($credentials['password'], $user->password)) {
                throw new \Exception('E-mail/Usuario ou senha estão incorretos');
            }
            return $user;
        } catch (\Exception $th) {
            throw $th;
        }
    }

    /**
    * AUTH - LOGIN PELA PLATAFORMA
    *
    * @param Array: Dados de Login (email, google Token)
    * @return User: App\Models\User;
    */
    public function google(Request $request){
        try {
            $token = $request->id_token ?? null;
            $httpClient = new \GuzzleHttp\Client([
                "verify" => false
            ]);
            $googleClient = new GoogleClient(['client_id' => config('services.google.client_id')]);
            $googleClient->setHttpClient($httpClient);
            $payload = $googleClient->verifyIdToken($token);
            if (!$payload) {
                Log::channel('auth')->error("[Erro de Authenticação][Google]", [
                    "message" => "Token inválido",
                    'token' => substr($token, 0, 50) . '...',
                    'client_id' => config('services.google.client_id')
                ]);
                throw new \Exception('Token Invalido');
            }
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

    /**
    * AUTH - LOGIN PELA PLATAFORMA
    *
    * @param Array: Dados de Login (UUID)
    * @return Void;
    */
    public function logout(Request $request){
        try {
            if(!empty($request->all()) && isset($request['uuid'])){
                return response()->json(['user' => null],200);
            }else{
                return response()->json(['message' => 'Houve um erro ao efetura logout. Usuario não especificado!'], 500);
            }
        }catch(\Exception $e) {
            Log::channel('auth')->error("[Erro de Logout][Usuario][Auth]", ['[message]' => $e->getMessage(), '[error]' => $e->getTraceAsString()]);
            return response()->json(['message' => 'Houve um erro ao efetura logout. Tente novamente mais tarde!'], 500);
        }
    }
}
