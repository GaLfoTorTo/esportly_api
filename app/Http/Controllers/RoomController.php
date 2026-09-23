<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoomService;

class RoomController extends Controller
{    
    public function __construct(private readonly RoomService $roomService) {}

    /**
     * ROOM - ENTRADA NA SALA DO EVENTO
     * 
     * Route: POST /api/events/{uuid}/room/join;
     * @param Request: request;
     * @return String: Mensagem de entrada
    */
    public function join(Request $request){
        //BUSCAR EVENTO PELO UUID
        $uuid  = $request->segment(3);
        $this->roomService->join($uuid);
        return response()->json(['message' => 'Bem-Vindo.'], 200);
    }
    
    /**
     * ROOM - SAÍDA DE SALA DO EVENTO
     * 
     * Route: POST /api/events/{uuid}/room/exit;
     * @param Request: request;
     * @return String: Mensagem de saída
    */
    public function exit(Request $request){
        //BUSCAR EVENTO PELO UUID
        $uuid  = $request->segment(3);
        $this->roomService->exit($uuid);
        return response()->json(['message' => 'Até a próxima.'], 200);
    }

    /**
     * ROOM - DE ABERTURA/FECHAMENTO DE SALA DO EVENTO
     * 
     * Route: POST /api/events/{uuid}/room/stream;
     * @param Request: Objeto de parametros da sala
     * @return String: Mensagem de status da sala
    */
    public function stream(Request $request){
        //BUSCAR EVENTO PELO UUID
        $uuid  = $request->segment(3);
        $status = $this->roomService->stream($uuid, $request->status);
        $message = $status ? 'aberta': 'fechada';
        return response()->json(['message' => "Sala $message."], 200);
    }
}
