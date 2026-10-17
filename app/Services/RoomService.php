<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
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
    public function join(string $uuid): void
    {
        $event  = Event::where('uuid', $uuid)->firstOrFail();
        Redis::sadd($this->participantsKey($uuid), auth()->id());
        $event->load('room');
        broadcast(new RoomEvent($event, $this->participants($uuid)));
    }

    /**
     * ROOM - SAIR DA SALA DO EVENTO
     *
     * @param String: Uuid evento;
     * @return void:
    */
    public function exit(string $uuid): void
    {
        $event  = Event::where('uuid', $uuid)->firstOrFail();
        Redis::srem($this->participantsKey($uuid), auth()->id());
        $event->load('room');
        broadcast(new RoomEvent($event, $this->participants($uuid)));
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
            //LIMPAR LISTA DE PRESENTES AO FECHAR A SALA
            //GERENCIAR LISTA DE PRESENTES
            if ($status === 'close') {
                Redis::del($this->participantsKey($uuid));
            } else {
                Redis::sadd($this->participantsKey($uuid), auth()->id());
            }
            //DISPARAR EVENTO DE ABERTURA OU FECHAMENTO DE SALA
            broadcast(new RoomEvent($event, $this->participants($uuid)));
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
            body:  "Sala aberta! Entre para confirmar sua presença e acompanhar tudo ao vivo",
            data:  [
                'type'       => 'room_opened',
                'event_uuid' => $event->uuid,
                'event_id'   => (string) $event->id,
            ],
        );
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────

    private function participantsKey(string $uuid): string
    {
        return "room:participants:{$uuid}";
    }

    public function participants(string $uuid): array
    {
        return Redis::smembers($this->participantsKey($uuid)) ?? [];
    }
}