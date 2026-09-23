<?php

namespace App\Services;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\Game;
use App\Models\Team;
use App\Resources\GameResource;

class GameService
{
    private const DAY_MAP = [
        0 => 'dom',
        1 => 'seg',
        2 => 'ter',
        3 => 'qua',
        4 => 'qui',
        5 => 'sex',
        6 => 'sab',
    ];

    /**
     * PARTIDAS - BUSCAR PARTIDAS DO EVENTO
     *
     * @param Event $event
     * @return array { preview: bool, date: string, games: Lista App\Models\Game }
     */
    public function get(?string $uuid): AnonymousResourceCollection
    {
        try {
            //BUSCAR EVENTO
            $event = Event::with('gameConfig')->where('uuid', $uuid)->firstOrFail();
            //ENCONTRAR O DIA MAIS PRÓXIMO (>= HOJE) QUE PERTENCE AO EVENTO
            $targetDate = $this->resolveNextDate($event);

            if (!$targetDate) {
                return GameResource::collection([]);
            }

            //BUSCAR PARTIDAS JÁ GERADAS NO BANCO
            $games = Game::where('event_id', $event->id)
                ->whereDate('date', $targetDate)
                ->when(
                    $targetDate->isToday(),
                    //HOJE: IN_PROGRESS PRIMEIRO, DEPOIS SCHEDULED POR HORÁRIO
                    fn($q) => $q->orderByRaw("FIELD(status, 'in_progress', 'scheduled', 'finished', 'cancelled')")
                               ->orderBy('start_time'),
                    //OUTRO DIA: APENAS AGENDADAS POR HORÁRIO
                    fn($q) => $q->where('status', 'scheduled')->orderBy('start_time')
                )
                ->with(['result', 'teams'])
                ->get();

            if ($games->isNotEmpty()) {
                $games = $this->setTeams($games, $event->gameConfig);
                return GameResource::collection($games);
            }

            //FALLBACK: CALCULAR PREVISÃO COM BASE NA GAMECONFIG
            $preview = $this->preview($event, $targetDate);

            return GameResource::collection($preview);

        } catch (\Exception $e) {
            Log::channel('events')->error("[Erro ao buscar partidas do evento][Partidas][GameService]", ['[event_id]' => $event->id, '[message]' => $e->getMessage(), '[error]' => $e->getTraceAsString()]);
            throw new \Exception("Ocorreu um erro ao buscar as partidas do evento. Por favor, tente novamente.");
        }
    }

    /**
     * PARTIDAS - GERAR TIMES NAS PARTIDAS
     *
     * @param Collection: Lista de partidas
     * @return Collection: Lista de partidas com equipes configuradas
     */
    private function setTeams(\Illuminate\Database\Eloquent\Collection $games): \Illuminate\Database\Eloquent\Collection
    {
        $allGames = $games->filter(fn($g) => $g->teams->isEmpty());

        if ($allGames->isEmpty()) {
            return $games;
        }

        foreach ($allGames as $game) {
            $gameTeams = collect();
            for($i = 1; $i <= 2; $i++) {
                $gameTeams->push(
                    new Team([
                        'uuid'   => (string) Str::uuid(),
                        'name'   => "Equipe $i",
                        'emblem' => "emblema_". random_int(1, 8),
                        'game_id' => $game->id,
                    ])
                );
            }
            $game->setRelation('teams', $gameTeams);
        }

        return $games;
    }

    /**
     * PARTIDAS - GERAR PARTIDAS DE PREVIEW DO EVENTO
     *
     * @param Event $event
     * @return GameResource: Lista de App\Models\Game
     */
    private function preview(Event $event, Carbon $targetDate): array
    {
        try {
            $config = $event->gameConfig;

            if (!$config || !$config->duration) {
                Log::channel('events')->error("[Previsão impossível: evento sem GameConfig][Partidas][GameService]", ['[event_id]' => $event->id]);
                return [];
            }

            $start        = Carbon::parse($event->start_time);
            $end          = Carbon::parse($event->end_time);
            $current      = $start->copy();
            $number       = 1;
            $preview      = [];

            while ($current->copy()->addMinutes($config->duration)->lte($end)) {
                $slotEnd = $current->copy()->addMinutes($config->duration);

                $teams = array_map(fn($p) => [
                    'uuid'   => (string) Str::uuid(),
                    'name'   => "Equipe $p",
                    'emblem' => "emblema_". random_int(1, 8),
                ], [1, 2]);

                $preview[] = new Fluent([
                    'id'         => null,
                    'number'     => $number,
                    'event_id'   => $event->id,
                    'referee_id' => $config->referee_id,
                    'duration'   => $config->duration,
                    'date'       => $targetDate->toDateString(),
                    'start_time' => $current->format('H:i:s'),
                    'end_time'   => $slotEnd->format('H:i:s'),
                    'status'     => 'scheduled',
                    'result'     => null,
                    'teams'      => $teams,
                    'created_at' => null,
                    'updated_at' => null,
                    'deleted_at' => null,
                ]);

                $current->addMinutes($config->duration);
                $number++;
            }

            return $preview;

        } catch (\Exception $e) {
            Log::channel('events')->error("[Erro ao calcular previsão de partidas][Partidas][GameService]", ['[event_id]' => $event->id, '[message]' => $e->getMessage(), '[error]' => $e->getTraceAsString()]);
            return [];
        }
    }

    /**
     * PARTIDAS - RESOLVER PROXIMO DIA DE EVENTO
     *
     * @param Event $event
     * @return Carbon: date
     */
    private function resolveNextDate(Event $event): ?Carbon
    {
        $eventDays = $event->date ?? [];

        if (empty($eventDays)) {
            return null;
        }

        $candidate = Carbon::today();

        for ($i = 0; $i < 7; $i++) {
            $abbr = self::DAY_MAP[$candidate->dayOfWeek];
            if (in_array($abbr, $eventDays)) {
                return $candidate;
            }
            $candidate->addDay();
        }

        return null;
    }
}
