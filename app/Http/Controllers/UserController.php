<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Services\UserService;
use App\Services\EventService;
use App\Models\User;
use App\Models\Player;
use App\Models\Manager;
use App\Models\Position;
use App\Models\PlayerPosition;

class UserController extends Controller
{
    /** 
    * USER - CRIAÇÃO DE USUÁRIO
    *
    * @param Request: Dados do Usuário, Dados de Modo Jogador e Dados
    * @return String: Mensagem de Sucesso ou Erro;
    */
    public function create(Request $request){
        DB::beginTransaction();
        try {
            if(!empty($request->all())){
                $userService = new UserSerivce();
                $userService->create($request->all());
                DB::commit();
                return response()->json(['message' => 'Usuário registrado com sucesso!'], 200);
            }else{
                return response()->json(['message' => 'Os dados do usuário estão vazios!'], 400);
            }
        }catch(\Exception $e) {
            Log::channel('register')->error("[Erro de Registro][User][Registro]", ['[message]' => $e->getMessage(), '[error]' => $e->getTraceAsString()]);
            return response()->json(['message' => 'Houve um erro ao registrar o Usuário.'], 400);
        }
    }

    /**
    * USER - EVENTOS DO USUARIO
    *
    * @param Request: Dados do Usuário, Dados de Modo Jogador e Dados
    * @return EventResource || []: Collection App\Models\Event
    */
    public function events(Request $request){
        try {
            $eventService = new EventService();
            $user = auth()->user();
            $events = $eventService->get($user->id);
            return response()->json(['events' => $events], 200);
        } catch (\Exception $e) {
            Log::channel('register')->error("[Erro ao buscar eventos do usuário]", ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['message' => 'Houve um erro ao buscar os eventos do usuário.'], 500);
        }
    }
}
