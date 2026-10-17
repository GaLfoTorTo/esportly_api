<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoomService;

class RoomController extends Controller
{    
    public function __construct(private readonly RoomService $roomService) {}

    /**
     * ROOM - ENTRADA/SAIR NA SALA DO EVENTO
     * 
     * Route: POST /api/events/{uuid}/room/{join/exit};
     * @param Request: request;
     * @return String: Mensagem de entrada
    */
    public function room(Request $request){
        try {
            //BUSCAR EVENTO PELO UUID
            $uuid  = $request->segment(3);
            if($request->segment(5) == 'join'){
                $this->roomService->join($uuid);
            }else{
                $this->roomService->exit($uuid);
            }
            return response()->json(200);
        }catch(\Exception $e) {
            //CAPTURAR ERRO E ENVIAR PARA O LOG
            Log::channel('events')->error("[Erro ao entrar na sala][Room]", ['[message]' => $e->getMessage(), '[error]' => $e->getTraceAsString()]);
            //REDIRECIONAR PARA O FORMULÁRIO COM A MENSAGEM DE ERRO
            throw new \Exception("Ocorreu um erro ao entrar na sala do evento. Por favor, tente novamente.");
        }
    }

    /**
     * ROOM - DE ABERTURA/FECHAMENTO DE SALA DO EVENTO
     * 
     * Route: POST /api/events/{uuid}/room/{open/close};
     * @param Request: Objeto de parametros da sala
     * @return String: Mensagem de status da sala
    */
    public function stream(Request $request){
        try {
            //BUSCAR EVENTO PELO UUID
            $uuid  = $request->segment(3);
            $action  = $request->segment(5);
            $status = $this->roomService->stream($uuid, $action);
            return response()->json(200);
        }catch(\Exception $e) {
            //CAPTURAR ERRO E ENVIAR PARA O LOG
            Log::channel('events')->error("[Erro ao iniciar sala][Room]", ['[message]' => $e->getMessage(), '[error]' => $e->getTraceAsString()]);
            //REDIRECIONAR PARA O FORMULÁRIO COM A MENSAGEM DE ERRO
            throw new \Exception("Ocorreu um erro ao iniciar sala do evento. Por favor, tente novamente.");
        }
    }
}
