<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventRoomService;

class RoomController extends Controller
{    
    public function __construct(private readonly EventRoomService $roomService) {}

    /**
     * ROOM - ENTRADA NA SALA DO EVENTO
     * 
     * Route: POST /api/events/room/join;
     * @param Request: UUID do Usuário;
     * @return String: Mensagem de entrada
    */
    public function join(Request $request): JsonResponse
    {
        $this->roomService->join($request->uuid);
        return response()->json(['message' => 'Bem-Vindo.'], 200);
    }
    
    /**
     * ROOM - SAÍDA DE SALA DO EVENTO
     * 
     * Route: POST /api/events/room/exit;
     * @param Request: UUID do Usuário;
     * @return String: Mensagem de saída
    */
    public function exit(Request $request): JsonResponse
    {
        $this->roomService->exit($request->uuid);
        return response()->json(['message' => 'Até a próxima.'], 200);
    }

    /**
     * ROOM - DE ABERTURA/FECHAMENTO DE SALA DO EVENTO
     * 
     * Route: POST /api/events/room/stream;
     * @param Request: Objeto de parametros da sala
     * @return String: Mensagem de status da sala
    */
    public function stream(Request $request): JsonResponse
    {
        $status = $this->roomService->stream($request->uuid, $request->status);
        $message = $status ? 'aberta': 'fechada';
        return response()->json(['message' => "Sala $message com sucesso."], 200);
    }
}
