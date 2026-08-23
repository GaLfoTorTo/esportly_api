<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\User;
use App\Models\Participant;
use App\Resources\EventResource;

class EventService
{
    /**
    * EVENTO - BUSCAR EVENTO
    * @param int: Id do evento
    * @return EventResource - App\Models\Event: Evento ;
    */
    public function find(int $id)
    {
        //BUSCAR EVENTO A PARTIR DO ID
        $event = Event::find($id);
        return EventResource::make($event);
    }
    
    /**
    * EVENTOS - BUSCAR EVENTOS DO USUÁRIO
    * @param int $id: ID do usuário
    * @return EventResource[]: Collection de eventos formatados;
    */
    public function get(?int $id=null)
    {
        $events = Event::with(['address', 'gameConfig', 'avaliations', 'participants', 'rules', 'news', 'games'])
                        ->when($id, fn($q) => $q->whereHas('participants', fn($q) => $q->where('user_id', $id)))
                        ->get();

        return EventResource::collection($events);
    }

    /**
    * EVENTOS - CRIAÇÃO DE EVENTOS
    * @param Request: Dados do Evento e Participantes;
    * @return EventResource - App\Models\Event: Evento;
    */
    public function create(Request $request)
    {
        //INICIALIZAR TRANSAÇÃO NO DB
        DB::beginTransaction();
        //DEFINIR DADOS BASICOS DA PELADA
        $data = [
            'uuid' => (string) Str::uuid(),
            'title'=> $request['title'],
            'bio'=> $request['bio'],
            'address'=> $request['address'],
            'number'=> $request['number'],
            'city'=> $request['city'],
            'state'=> $request['state'],
            'complement'=> $request['complement'],
            'country'=> $request['country'],
            'zip_code'=> $request['zip_code'],
            'days_week'=> json_encode($request['days_week']),
            'date'=> date('Y-m-d', strtotime($request['date'])),
            'time'=> date('H:i', strtotime($request['time'])),
            'category'=> $request['category'],
            'qtd_players'=> $request['qtd_players'],
            'visibility'=> $request['visibility'],
            'allow_collaborators'=> $request['allow_collaborators'],
        ];
        //VERIFICAR SE FOI RECEBIDO FOTO DO USUÁRIO
        if($request->hasFile('photo')){
            //RESGATAR RESQUEST PARA FUNÇÃO DE UPLOAD
            $dataFile['request'] = $request;
            //DEFINIR PASTA DE ARQUIVOS DO USUARIO
            $dataFile['pasta'] = 'events/'.$data['uuid'];
            //SALVAR FOTO DE USUARIO
            $data['photo'] = upload($dataFile);
        }
        //SALVAR EVENTO
        $event = Event::create($data);
        //SALVAR PARTICIPANTES
        $this->participantsEvent($request->participantes, $event->id);
        //CONSOLIDAR OPERAÇÃO
        DB::commit();
        return new EventResource($event);
    }

    private function participantsEvent($request, $event_id){
        //VERIFICAR SE FOI RECEBIDO PARTICPANTES
        if(!empty($request->participantes)){
            //DECODIFICAR PARTICIPANTES
            $participantes = json_decode($request->participantes);
            //VERIFICAR SE O USUÁRIO É UM PARTICIPANTE
            foreach($participantes as $key => $item){
                //VERIFICAR SE O USUÁRIO É UM PARTICIPANTE
                if(isset($item['user_id']) && !empty($item['user_id'])){
                    //SALVAR PARTICIPANTE
                    Participant::create([
                        'event_id' => $event_id,
                        'user_id' => $item['user_id'],
                        'role' => $request->roles,
                        'permissions' => $request->permissions,
                        'status' => 'Avaliable',
                        'joinedt_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            }

        }
    }
}