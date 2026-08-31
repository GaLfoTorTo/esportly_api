<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TaskSeed extends Seeder
{
    public function run(): void
    {
        $tasks = [

            /*
            |--------------------------------------------------------------------------
            | ONBOARDING — execução única, geral
            |--------------------------------------------------------------------------
            */

            [
                'title'       => 'Informações de Conta',
                'description' => 'Complete informações da conta.',
                'points'      => 10,
                'category'    => 'onboarding',
                'modality'    => null,
            ],
            [
                'title'       => 'Definir posição favorita',
                'description' => 'Defina sua posição favorita como jogador.',
                'points'      => 10,
                'category'    => 'player',
                'modality'    => null,
            ],
            [
                'title'       => 'Definir melhor lado',
                'description' => 'Defina sua orientação com os pés ou com as mãos.',
                'points'      => 10,
                'category'    => 'player',
                'modality'    => null,
            ],
            [
                'title'       => 'Definir Arquétipo',
                'description' => 'Defina seu arquétipo.',
                'points'      => 10,
                'category'    => 'player',
                'modality'    => null,
            ],
            [
                'title'       => 'Definir Nº',
                'description' => 'Defina seu Nº favorito.',
                'points'      => 10,
                'category'    => 'player',
                'modality'    => null,
            ],
            [
                'title'       => 'Definir equipe',
                'description' => 'Defina o nome, abriviação e cores da sua equipe.',
                'points'      => 10,
                'category'    => 'manager',
                'modality'    => null,
            ],
            [
                'title'       => 'Definir emblema',
                'description' => 'Defina o emblema da sua equipe.',
                'points'      => 10,
                'category'    => 'manager',
                'modality'    => null,
            ],
            [
                'title'       => 'Definir Kit',
                'description' => 'Defina o uniforme da sua equipe.',
                'points'      => 10,
                'category'    => 'manager',
                'modality'    => null,
            ],

            /*
            |--------------------------------------------------------------------------
            | PARTICIPATION — acumulativa, geral
            |--------------------------------------------------------------------------
            */

            [
                'title'       => 'Participar de uma pelada',
                'description' => 'Torna-se participante de uma pelada.',
                'points'      => 50,
                'category'    => 'participation',
                'modality'    => null,
            ],
            [
                'title'       => 'Avaliar pelada',
                'description' => 'Avalie uma pelada.',
                'points'      => 100,
                'category'    => 'participation',
                'modality'    => null,
            ],
            [
                'title'       => 'Amizade',
                'description' => 'Convide amigos para uma pelada.',
                'points'      => 50,
                'category'    => 'participation',
                'modality'    => null,
            ],
            [
                'title'       => 'Participar de partida',
                'description' => 'Participe de uma partida.',
                'points'      => 30,
                'category'    => 'participation',
                'modality'    => null,
            ],

            /*
            |--------------------------------------------------------------------------
            | ORGANIZATION — acumulativa, geral
            |--------------------------------------------------------------------------
            */

            [
                'title'       => 'Criar evento',
                'description' => 'Crie um novo evento esportivo na plataforma.',
                'points'      => 50,
                'category'    => 'organization',
                'modality'    => null,
            ],
            [
                'title'       => 'Convidar Participants',
                'description' => 'Convide novos participants para a pelada.',
                'points'      => 50,
                'category'    => 'organization',
                'modality'    => null,
            ],

            /*
            |--------------------------------------------------------------------------
            | SOCIAL — acumulativa e única, geral
            |--------------------------------------------------------------------------
            */

            [
                'title'       => 'Convidar amigo',
                'description' => 'Envie 1 convite para um novo usuário.',
                'points'      => 10,
                'category'    => 'social',
                'modality'    => null,
            ],
            [
                'title'       => 'Aceitar solicitação de amizade',
                'description' => 'Aceite uma solicitação de amizade de um usuário.',
                'points'      => 10,
                'category'    => 'social',
                'modality'    => null,
            ],

            /*
            |--------------------------------------------------------------------------
            | MANAGER 
            |--------------------------------------------------------------------------
            */

            [
                'title'       => 'Escalaçao',
                'description' => 'Escale sua primeira equipe.',
                'points'      => 15,
                'category'    => 'manager',
                'modality'    => null,
            ],

            /*
            |--------------------------------------------------------------------------
            | PERFORMANCE — Futebol
            |--------------------------------------------------------------------------
            */

            [
                'title'       => 'Marcar Gol',
                'description' => 'Marque um gol em uma partida de futebol.',
                'points'      => 10,
                'category'    => 'performance',
                'modality'    => 'Football',
            ],
            [
                'title'       => 'Assistência',
                'description' => 'Deu uma assistência em uma partida de futebol.',
                'points'      => 10,
                'category'    => 'performance',
                'modality'    => 'Football',
            ],
            [
                'title'       => 'Hat-trick',
                'description' => 'Marque 3 ou mais gols em uma única partida de futebol.',
                'points'      => 50,
                'category'    => 'performance',
                'modality'    => 'Football',
            ],
            [
                'title'       => 'Vitória',
                'description' => 'Vença uma partida de futebol.',
                'points'      => 100,
                'category'    => 'performance',
                'modality'    => 'Football',
            ],
            [
                'title'       => 'Partida sem sofrer gol',
                'description' => 'Termine uma partida sem sofrer gol.',
                'points'      => 20,
                'category'    => 'performance',
                'modality'    => 'Football',
            ],

            /*
            |--------------------------------------------------------------------------
            | PERFORMANCE — Vôlei
            |--------------------------------------------------------------------------
            */

            [
                'title'       => 'Ace',
                'description' => 'Realizou um ace de saque em uma partida.',
                'points'      => 20,
                'category'    => 'performance',
                'modality'    => 'Volleyball',
            ],
            [
                'title'       => 'Bloqueio',
                'description' => 'Realizar um bloqueio bem-sucedido em partida de vôlei.',
                'points'      => 15,
                'category'    => 'performance',
                'modality'    => 'Volleyball',
            ],
            [
                'title'       => 'Defesa difícil',
                'description' => 'Realizar uma defesa difícil com êxito em partida de vôlei.',
                'points'      => 15,
                'category'    => 'performance',
                'modality'    => 'Volleyball',
            ],
            [
                'title'       => 'Ponto',
                'description' => 'Marcar um ponto em partida de vôlei.',
                'points'      => 10,
                'category'    => 'performance',
                'modality'    => 'Volleyball',
            ],
            [
                'title'       => 'Vitória (vôlei)',
                'description' => 'Vença uma partida de vôlei.',
                'points'      => 100,
                'category'    => 'performance',
                'modality'    => 'Volleyball',
            ],

            /*
            |--------------------------------------------------------------------------
            | PERFORMANCE — Basquete
            |--------------------------------------------------------------------------
            */

            [
                'title'       => 'Marcar Ponto',
                'description' => 'Marcar uma cesta (2x).',
                'points'      => 10,
                'category'    => 'performance',
                'modality'    => 'Basketball',
            ],
            [
                'title'       => 'Cesta de 3 pontos',
                'description' => 'Marcar uma cesta de 3 pontos.',
                'points'      => 20,
                'category'    => 'performance',
                'modality'    => 'Basketball',
            ],
            [
                'title'       => 'Assistência',
                'description' => 'Faça uma assistência.',
                'points'      => 10,
                'category'    => 'performance',
                'modality'    => 'Basketball',
            ],
            [
                'title'       => 'Rebote',
                'description' => 'Realize um rebote ofensivo ou defensivo.',
                'points'      => 10,
                'category'    => 'performance',
                'modality'    => 'Basketball',
            ],
            [
                'title'       => 'Roubo de bola',
                'description' => 'Realize um roubo de bola.',
                'points'      => 10,
                'category'    => 'performance',
                'modality'    => 'Basketball',
            ],
            [
                'title'       => 'Bloqueio de arremesso',
                'description' => 'Realize um bloqueio de arremesso.',
                'points'      => 15,
                'category'    => 'performance',
                'modality'    => 'Basketball',
            ],
            [
                'title'       => 'Triple-double',
                'description' => 'Atingiu dois dígitos em 3 categorias (pts/rb/ast) em uma única partida.',
                'points'      => 200,
                'category'    => 'performance',
                'modality'    => 'Basketball',
            ],
            [
                'title'       => 'Vitória (basquete)',
                'description' => 'Vença uma partida de basquete.',
                'points'      => 100,
                'category'    => 'performance',
                'modality'    => 'Basketball',
            ],

            /*
            |--------------------------------------------------------------------------
            | PERFORMANCE — Arbitro
            |--------------------------------------------------------------------------
            */

            [
                'title'       => 'Apitar',
                'description' => 'Apite uma partida como árbitro.',
                'points'      => 100,
                'category'    => 'performance',
                'modality'    => 'Basketball',
            ],
        ];

        foreach ($tasks as &$task) {
            $task['uuid']       = (string) Str::uuid();
            $task['created_at'] = now();
            $task['updated_at'] = now();
        }

        DB::table('tasks')->insert($tasks);
    }
}
