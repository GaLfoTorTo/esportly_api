<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('actions')->insert([

            // ----------------------------------------------------------------
            // FOOTBALL — Scouts de ataque
            // ----------------------------------------------------------------
            ['title' => 'Goal',          'modality' => 'Footeball',  'description' => 'Gol marcado.',                              'score' =>  8.0],
            ['title' => 'Assist',        'modality' => 'Footeball',  'description' => 'Assistência para gol.',                     'score' =>  5.0],
            ['title' => 'ShotOnPost',    'modality' => 'Footeball',  'description' => 'Finalização na trave.',                     'score' =>  1.5],
            ['title' => 'ShotSaved',     'modality' => 'Footeball',  'description' => 'Finalização defendida.',                    'score' =>  1.0],
            ['title' => 'ShotMissed',    'modality' => 'Footeball',  'description' => 'Finalização para fora.',                    'score' =>  0.3],
            ['title' => 'FoulTaken',     'modality' => 'Footeball',  'description' => 'Falta sofrida.',                            'score' =>  0.5],

            // ----------------------------------------------------------------
            // FOOTBALL — Scouts de defesa
            // ----------------------------------------------------------------
            ['title' => 'Defense',       'modality' => 'Footeball',  'description' => 'Desarme ou bloqueio defensivo.',            'score' =>  2.5],
            ['title' => 'CleanSheet',    'modality' => 'Footeball',  'description' => 'Jogo sem sofrer gols.',                     'score' =>  5.0],
            ['title' => 'PenaltySave',   'modality' => 'Footeball',  'description' => 'Defesa de pênalti.',                        'score' =>  8.0],
            ['title' => 'GoalkeeperSave','modality' => 'Footeball',  'description' => 'Defesa de Goleiro.',                        'score' =>  3.0],
            ['title' => 'GoalkeeperFail','modality' => 'Footeball',  'description' => 'Gol Sofrido.',                              'score' => -5.0],

            // ----------------------------------------------------------------
            // FOOTBALL — Ações complementares
            // ----------------------------------------------------------------
            ['title' => 'Penalty',       'modality' => 'Footeball',  'description' => 'Pênalti convertido.',                       'score' =>  8.0],
            ['title' => 'PenaltyMissed', 'modality' => 'Footeball',  'description' => 'Pênalti perdido.',                          'score' => -5.0],
            ['title' => 'FreeKick',      'modality' => 'Footeball',  'description' => 'Cobrança de falta.',                        'score' =>  0.5],
            ['title' => 'Corner',        'modality' => 'Footeball',  'description' => 'Escanteio cobrado.',                        'score' =>  0.3],
            ['title' => 'Offside',       'modality' => 'Footeball',  'description' => 'Impedimento.',                              'score' => -1.3],
            ['title' => 'Foul',          'modality' => 'Footeball',  'description' => 'Falta cometida.',                           'score' => -0.5],
            ['title' => 'WrongPass',     'modality' => 'Footeball',  'description' => 'Passe errado.',                             'score' => -0.5],
            ['title' => 'OwnGoal',       'modality' => 'Footeball',  'description' => 'Gol contra.',                               'score' => -5.0],
            ['title' => 'RedCard',       'modality' => 'Footeball',  'description' => 'Cartão vermelho.',                          'score' => -5.0],
            ['title' => 'YellowCard',    'modality' => 'Footeball',  'description' => 'Cartão amarelo.',                           'score' => -3.0],

            // ----------------------------------------------------------------
            // BASKETBALL
            // ----------------------------------------------------------------
            ['title' => 'Point2',        'modality' => 'Basketball',  'description' => 'Cesta de 2 pontos.',                         'score' =>  1.0],
            ['title' => 'Point3',        'modality' => 'Basketball',  'description' => 'Cesta de 3 pontos.',                         'score' =>  2.0],
            ['title' => 'BasketAssist',  'modality' => 'Basketball',  'description' => 'Assistência para cesta.',                    'score' =>  1.0],
            ['title' => 'Rebound',       'modality' => 'Basketball',  'description' => 'Rebote ofensivo ou defensivo.',              'score' =>  1.0],
            ['title' => 'Steal',         'modality' => 'Basketball',  'description' => 'Roubo de bola.',                             'score' =>  2.0],
            ['title' => 'BlockShot',     'modality' => 'Basketball',  'description' => 'Bloqueio de arremesso.',                     'score' =>  2.0],
            ['title' => 'Turnover',      'modality' => 'Basketball',  'description' => 'Perda de posse de bola.',                    'score' => -1.0],
            ['title' => 'PersonalFoul',  'modality' => 'Basketball',  'description' => 'Falta pessoal cometida.',                    'score' => -1.0],

            // ----------------------------------------------------------------
            // VOLLEYBALL
            // ----------------------------------------------------------------
            ['title' => 'Ace',           'modality' => 'Volleyball',  'description' => 'Ponto direto de saque.',                     'score' =>  8.0],
            ['title' => 'Point',         'modality' => 'Volleyball',  'description' => 'Ponto de ataque.',                           'score' =>  3.0],
            ['title' => 'Block',         'modality' => 'Volleyball',  'description' => 'Ponto de Bloqueio.',                         'score' =>  5.0],
            ['title' => 'DefensiveSave', 'modality' => 'Volleyball',  'description' => 'Defesa difícil.',                            'score' =>  5.0],
            ['title' => 'ServingError',  'modality' => 'Volleyball',  'description' => 'Erro de saque.',                             'score' => -3.0],
            ['title' => 'Fault',         'modality' => 'Volleyball',  'description' => 'Falta ou ponto cedido por erro próprio.',    'score' => -1.0],
        ]);
    }
}
