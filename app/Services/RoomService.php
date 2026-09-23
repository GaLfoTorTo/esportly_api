<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\Event;
use App\Models\Room;
use App\Events\RoomEvent;
use App\Services\FcmService;

class RoomService
{
    public function __construct(private FcmService $fcm) {}

    /**
     * ROOM - ENTRADA NA SALA DO EVENTO
     * 
     * @param String: Uuid evento;
     * @return void:
    */
    public function join(string $uuid): Room
    {
        //DISPARAR EVENTO DE ENTRADA DE PARTICIPANTE NA SALA
    }

    /**
     * ROOM - SAIR DA SALA DO EVENTO
     * 
     * @param String: Uuid evento;
     * @return void:
    */
    public function exit(string $uuid): Room
    {
        //DISPARAR EVENTO DE SAIDA DE PARTICIPANTE NA SALA
    }

    /**
     * ROOM - INICIAR SALA DO EVENTO
     * 
     * @param String: Uuid evento;
     * @param String: STATUS da sala evento;
     * @return void:
    */
    public function stream(string $uuid, string $status): bool
    {
        try {
            //BUSCAR EVENTO
            $event = Event::where('uuid', $uuid)->firstOrFail();
            //CRIAR OU ATUALIZAR STATUS DA SALA
            $room = Room::updateOrCreate(
                [
                    'event_id' => $event->id
                ],
                [
                    'event_id'  => $event->id,
                    'status'    => $status,
                    'opened_at' => now(),
                ]
            );
            //CARREGAR SALA NO EVENT
            $event->load('room');
            //DISPARAR EVENTO DE ABERTURA OU FECHAMENTO DE SALA
            broadcast(new RoomEvent($event));
            //DISPARAR NOTIFICAÇÃO DE ABERTURA DE SALA
            $this->notify($event);
            return true;
        } catch (\Exception $e) {
            //REGISTAR ERRO NO LOG
            Log::error("[Erro ao iniciar a sala][Evento][uuid=$uuid]", ['error' => $e->getMessage(), 'stack' => $e->getTraceAsString()]);
            return false;
        }
    }

    /**
     * ROOM - NOTIFICAÇÃO DE ENTRADA NA SALA DO EVENTO
     * 
     * @param Event: evento;
     * @return void:
    */
    private function notify(Event $event): void
    {
        //DEFINIR TOPICO DO CANAL DE EVENTO
        $topic = 'event_' . str_replace('-', '_', $event->uuid);
        //DISPARAR NOTIFICAÇÃO
        $this->fcm->sendToTopic(
            topic: $topic,
            title: "{$event->title} — Dia de Jogo!",
            body:  "Pelada ta no ar! Entre na sala para acompanhar tudo ao vivo.",
            data:  [
                'type'       => 'room_opened',
                'event_uuid' => $event->uuid,
                'event_id'   => (string) $event->id,
            ],
        );
    }
}