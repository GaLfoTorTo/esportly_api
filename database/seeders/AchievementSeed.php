<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class AchievementSeed extends Seeder
{
    public function run()
    {
        $achievements = [

            /*
            |--------------------------------------------------------------------------
            | GERAL — Conta & Onboarding
            |--------------------------------------------------------------------------
            */
            [
                'title'          => 'Geral - Perfil Completo',
                'description'    => 'Completou todas as informações do perfil.',
                'points'         => 0,
                'image'          => 'achivment_1.png',
                'rarity'         => 'Basic',
                'required_count' => 1,
            ],
            [
                'title'          => 'Jogador licenciado',
                'description'    => 'Preencheu todas as configurações de jogador.',
                'points'         => 0,
                'image'          => 'achivment_2.png',
                'rarity'         => 'Basic',
                'required_count' => 4,
            ],
            [
                'title'          => 'Técnico licenciado',
                'description'    => 'Preencheu todas as configurações de técnico.',
                'points'         => 0,
                'image'          => 'achivment_3.png',
                'rarity'         => 'Basic',
                'required_count' => 3,
            ],

            /*
            |--------------------------------------------------------------------------
            | EVENTO - Inicialização
            |--------------------------------------------------------------------------
            */

            [
                'title'          => 'Estreante',
                'description'    => 'Tornou-se membro de sua 1º pelada.',
                'points'         => 50,
                'image'          => 'achivment_4.png',
                'rarity'         => 'Basic',
                'required_count' => 1,
            ],
            [
                'title'          => 'Peladeiro Raiz',
                'description'    => 'Tornou-se membro de 3 peladas.',
                'points'         => 150,
                'image'          => 'achivment_4.png',
                'rarity'         => 'Common',
                'required_count' => 1,
            ],
            [
                'title'          => 'Organizador Estreante',
                'description'    => 'Criou sua 1º pelada.',
                'points'         => 100,
                'image'          => 'achivment_5.png',
                'rarity'         => 'Common',
                'required_count' => 1,
            ],
            [
                'title'          => 'Organizador Raiz',
                'description'    => 'Criou 3 peladas.',
                'points'         => 300,
                'image'          => 'achivment_6.png',
                'rarity'         => 'Common',
                'required_count' => 1,
            ],

            /*
            |--------------------------------------------------------------------------
            | EVENTO — Participação
            |--------------------------------------------------------------------------
            */
            [
                'title'          => 'Novo Começo',
                'description'    => 'Participou da primeira partida.',
                'points'         => 50,
                'image'          => 'achivment_4.png',
                'rarity'         => 'Basic',
                'required_count' => 1,
            ],
            [
                'title'          => 'Frequentador',
                'description'    => 'Participou de 5 partidas.',
                'points'         => 150,
                'image'          => 'achivment_43.png',
                'rarity'         => 'Common',
                'required_count' => 5,
            ],
            [
                'title'          => 'Titular',
                'description'    => 'Participou de 10 partidas.',
                'points'         => 200,
                'image'          => 'achivment_44.png',
                'rarity'         => 'Common',
                'required_count' => 10,
            ],
            [
                'title'          => 'Indispensável',
                'description'    => 'Participou de 50 partidas.',
                'points'         => 500,
                'image'          => 'achivment_45.png',
                'rarity'         => 'Common',
                'required_count' => 50,
            ],
            [
                'title'          => 'Centenário',
                'description'    => 'Participou de 100 partidas.',
                'points'         => 1000,
                'image'          => 'achivment_46.png',
                'rarity'         => 'Rare',
                'required_count' => 100,
            ],
            [
                'title'          => 'Veternano',
                'description'    => 'Participou de 300 partidas.',
                'points'         => 3000,
                'image'          => 'achivment_46.png',
                'rarity'         => 'Rare',
                'required_count' => 100,
            ],
            [
                'title'          => 'Craque',
                'description'    => 'Participou de 500 partidas.',
                'points'         => 5000,
                'image'          => 'achivment_47.png',
                'rarity'         => 'Epic',
                'required_count' => 500,
            ],
            [
                'title'          => 'Lenda das Peladas',
                'description'    => 'Participou de 1.000 partidas.',
                'points'         => 10000,
                'image'          => 'achivment_47.png',
                'rarity'         => 'Legendary',
                'required_count' => 500,
            ],
            [
                'title'          => 'Invicto 5',
                'description'    => 'Ganhe 5 partidas seguidas.',
                'points'         => 250,
                'image'          => 'achivment_5.png',
                'rarity'         => 'Common',
                'required_count' => 1,
            ],
            [
                'title'          => 'Invicto 10',
                'description'    => 'Ganhe 10 partidas seguidas.',
                'points'         => 500,
                'image'          => 'achivment_6.png',
                'rarity'         => 'Common',
                'required_count' => 1,
            ],
            [
                'title'          => 'Invicto 30',
                'description'    => 'Ganhe 30 partidas seguidas.',
                'points'         => 15000,
                'image'          => 'achivment_6.png',
                'rarity'         => 'Epic',
                'required_count' => 1,
            ],
            [
                'title'          => 'Invicto 50',
                'description'    => 'Ganhe 50 partidas seguidas.',
                'points'         => 30000,
                'image'          => 'achivment_6.png',
                'rarity'         => 'Legendary',
                'required_count' => 1,
            ],
            [
                'title'          => 'Invicto 100',
                'description'    => 'Ganhe 100 partidas seguidas.',
                'points'         => 100000,
                'image'          => 'achivment_6.png',
                'rarity'         => 'Legendary',
                'required_count' => 1,
            ],

            /*
            |--------------------------------------------------------------------------
            | GERAL — Social
            |--------------------------------------------------------------------------
            */

            [
                'title'          => 'Primeiro Convite',
                'description'    => 'Convidou um amigo para sua pelada.',
                'points'         => 20,
                'image'          => 'achivment_7.png',
                'rarity'         => 'Basic',
                'required_count' => 1,
            ],
            [
                'title'          => 'Amigo de Verdade',
                'description'    => 'Seu amigo convidado entrou.',
                'points'         => 50,
                'image'          => 'achivment_9.png',
                'rarity'         => 'Common',
                'required_count' => 1,
            ],
            [
                'title'          => 'Conector',
                'description'    => '3 amigos convidados entraram no app.',
                'points'         => 150,
                'image'          => 'achivment_48.png',
                'rarity'         => 'Common',
                'required_count' => 3,
            ],
            [
                'title'          => 'Amigo da vizinhaça',
                'description'    => '5 amigo convidados entraram no app.',
                'points'         => 400,
                'image'          => 'achivment_8.png',
                'rarity'         => 'Common',
                'required_count' => 5,
            ],
            [
                'title'          => 'Embaixador',
                'description'    => '10 amigos convidados entraram no app.',
                'points'         => 800,
                'image'          => 'achivment_49.png',
                'rarity'         => 'Rare',
                'required_count' => 10,
            ],

            /*
            |--------------------------------------------------------------------------
            | JOGADOR ACTION - FOOTBALL - Artilharia
            |--------------------------------------------------------------------------
            */

            [
                'title'          => 'Football - Primeiro Gol',
                'description'    => 'Marque seu primeiro gol.',
                'points'         => 50,
                'image'          => 'achivment_1.png',
                'rarity'         => 'Common',
                'required_count' => 1,
            ],
            [
                'title'          => 'Football - Artilheiro 10',
                'description'    => 'Marque 10 gols.',
                'points'         => 100,
                'image'          => 'achivment_2.png',
                'rarity'         => 'Common',
                'required_count' => 10,
            ],
            [
                'title'          => 'Football - Artilheiro 50',
                'description'    => 'Marque 50 gols.',
                'points'         => 150,
                'image'          => 'achivment_3.png',
                'rarity'         => 'Rare',
                'required_count' => 50,
            ],
            [
                'title'          => 'Football - Artilheiro 100',
                'description'    => 'Marque 100 gols.',
                'points'         => 300,
                'image'          => 'achivment_3.png',
                'rarity'         => 'Rare',
                'required_count' => 100,
            ],
            [
                'title'          => 'Football - Artilheiro 200',
                'description'    => 'Marque 200 gols.',
                'points'         => 600,
                'image'          => 'achivment_3.png',
                'rarity'         => 'Rare',
                'required_count' => 200,
            ],
            [
                'title'          => 'Football - Artilheiro 500',
                'description'    => 'Marque 500 gols.',
                'points'         => 1200,
                'image'          => 'achivment_3.png',
                'rarity'         => 'Rare',
                'required_count' => 500,
            ],
            [
                'title'          => 'Football - Artilheiro 1.000',
                'description'    => 'Marque 1.000 gols.',
                'points'         => 50000,
                'image'          => 'achivment_3.png',
                'rarity'         => 'Rare',
                'required_count' => 1000,
            ],
            [
                'title'          => 'Football - Hat-Trick',
                'description'    => 'Marque 3 gols em uma partida.',
                'points'         => 200,
                'image'          => 'achivment_4.png',
                'rarity'         => 'Rare',
                'required_count' => 1,
            ],

            /*
            |--------------------------------------------------------------------------
            | JOGADOR ACTION - FOOTBALL - Assistencia
            |--------------------------------------------------------------------------
            */

            [
                'title'          => 'Football - Primeira Assistência',
                'description'    => 'Faça sua primeira assistência.',
                'points'         => 35,
                'image'          => 'achivment_1.png',
                'rarity'         => 'Common',
                'required_count' => 1,
            ],
            [
                'title'          => 'Football - Maestro 10',
                'description'    => 'Faça 10 assistências.',
                'points'         => 70,
                'image'          => 'achivment_2.png',
                'rarity'         => 'Common',
                'required_count' => 10,
            ],
            [
                'title'          => 'Football - Maestro 50',
                'description'    => 'Faça 50 assistências.',
                'points'         => 140,
                'image'          => 'achivment_3.png',
                'rarity'         => 'Rare',
                'required_count' => 50,
            ],
            [
                'title'          => 'Football - Maestro 100',
                'description'    => 'Faça 100 assistências.',
                'points'         => 280,
                'image'          => 'achivment_3.png',
                'rarity'         => 'Rare',
                'required_count' => 100,
            ],
            [
                'title'          => 'Football - Maestro 200',
                'description'    => 'Faça 200 assistências.',
                'points'         => 560,
                'image'          => 'achivment_3.png',
                'rarity'         => 'Epic',
                'required_count' => 200,
            ],
            [
                'title'          => 'Football - Maestro 500',
                'description'    => 'Faça 500 assistências.',
                'points'         => 1120,
                'image'          => 'achivment_3.png',
                'rarity'         => 'Epic',
                'required_count' => 500,
            ],
            [
                'title'          => 'Football - Maestro 1.000',
                'description'    => 'Faça 1.000 assistências.',
                'points'         => 20000,
                'image'          => 'achivment_3.png',
                'rarity'         => 'Legendary',
                'required_count' => 1000,
            ],

            /*
            |--------------------------------------------------------------------------
            | JOGADOR ACTION - FOOTBALL - Defesa goleiro
            |--------------------------------------------------------------------------
            */

            [
                'title'          => 'Football - Muralha',
                'description'    => 'Consiga 1 jogo sem sofrer gol.',
                'points'         => 200,
                'image'          => 'achivment_8.png',
                'rarity'         => 'Commin',
                'required_count' => 5,
            ],
            [
                'title'          => 'Football - Muralha 10',
                'description'    => 'Consiga 10 sem sofrer gol.',
                'points'         => 400,
                'image'          => 'achivment_2.png',
                'rarity'         => 'Rare',
                'required_count' => 10,
            ],
            [
                'title'          => 'Football - Muralha 50',
                'description'    => 'Consiga 50 sem sofrer gol.',
                'points'         => 800,
                'image'          => 'achivment_3.png',
                'rarity'         => 'Rare',
                'required_count' => 50,
            ],
            [
                'title'          => 'Football - Muralha 100',
                'description'    => 'Consiga 100 sem sofrer gol.',
                'points'         => 1600,
                'image'          => 'achivment_3.png',
                'rarity'         => 'Epic',
                'required_count' => 100,
            ],
            [
                'title'          => 'Football - Muralha 200',
                'description'    => 'Consiga 200 sem sofrer gol.',
                'points'         => 3200,
                'image'          => 'achivment_3.png',
                'rarity'         => 'Epic',
                'required_count' => 200,
            ],
            [
                'title'          => 'Football - Muralha 500',
                'description'    => 'Consiga 500 sem sofrer gol.',
                'points'         => 5000,
                'image'          => 'achivment_3.png',
                'rarity'         => 'Epic',
                'required_count' => 500,
            ],
            [
                'title'          => 'Football - Muralha 1000',
                'description'    => 'Consiga 1000 sem sofrer gol.',
                'points'         => 100000,
                'image'          => 'achivment_3.png',
                'rarity'         => 'Legendary',
                'required_count' => 1000,
            ],

            /*
            |--------------------------------------------------------------------------
            | JOGADOR ACTION - BASKETBALL — Pontuação
            |--------------------------------------------------------------------------
            */

            [
                'title'          => 'Basketball - Primeira Cesta',
                'description'    => 'Marque sua primeira cesta.',
                'points'         => 50,
                'image'          => 'achivment_11.png',
                'rarity'         => 'Common',
                'required_count' => 1,
            ],
            [
                'title'          => 'Basketball - Cestinha 100',
                'description'    => 'Acumule 100 pontos.',
                'points'         => 100,
                'image'          => 'achivment_12.png',
                'rarity'         => 'Common',
                'required_count' => 100,
            ],
            [
                'title'          => 'Basketball - Cestinha 500',
                'description'    => 'Acumule 500 pontos.',
                'points'         => 200,
                'image'          => 'achivment_12.png',
                'rarity'         => 'Common',
                'required_count' => 500,
            ],
            [
                'title'          => 'Basketball - Cestinha 1.000',
                'description'    => 'Acumule 1.000 pontos.',
                'points'         => 400,
                'image'          => 'achivment_13.png',
                'rarity'         => 'Rare',
                'required_count' => 1000,
            ],
            [
                'title'          => 'Basketball - Cestinha 5.000',
                'description'    => 'Acumule 5.000 pontos.',
                'points'         => 800,
                'image'          => 'achivment_13.png',
                'rarity'         => 'Epic',
                'required_count' => 5000,
            ],
            [
                'title'          => 'Basketball - Cestinha 10.000',
                'description'    => 'Acumule 10.000 pontos.',
                'points'         => 1600,
                'image'          => 'achivment_13.png',
                'rarity'         => 'Epic',
                'required_count' => 10000,
            ],
            [
                'title'          => 'Basketball - THE GOAT',
                'description'    => 'Acumule 20.000 pontos.',
                'points'         => 50000,
                'image'          => 'achivment_20.png',
                'rarity'         => 'Legendary',
                'required_count' => 20000,
            ],

            /*
            |--------------------------------------------------------------------------
            | JOGADOR ACTION - BASKETBALL — Eventos Especiais (por partida)
            |--------------------------------------------------------------------------
            */
 
            [
                'title'          => 'Basketball - Dominante 10',
                'description'    => 'Marcou 10 pontos em uma única partida.',
                'points'         => 100,
                'image'          => 'achivment_16.png',
                'rarity'         => 'comum',
                'required_count' => 1,
            ],
            [
                'title'          => 'Basketball - Dominante 20',
                'description'    => 'Marcou 20 pontos em uma única partida.',
                'points'         => 200,
                'image'          => 'achivment_16.png',
                'rarity'         => 'Rare',
                'required_count' => 1,
            ],
            [
                'title'          => 'Basketball - Dominante 30',
                'description'    => 'Marcou 30 pontos em uma única partida.',
                'points'         => 300,
                'image'          => 'achivment_16.png',
                'rarity'         => 'Rare',
                'required_count' => 1,
            ],
            [
                'title'          => 'Basketball - Dominante 40',
                'description'    => 'Marcou 40 pontos em uma única partida.',
                'points'         => 400,
                'image'          => 'achivment_16.png',
                'rarity'         => 'Epic',
                'required_count' => 1,
            ],
            [
                'title'          => 'Basketball - Dominante 50',
                'description'    => 'Marcou 50 pontos em uma única partida.',
                'points'         => 400,
                'image'          => 'achivment_16.png',
                'rarity'         => 'Legendary',
                'required_count' => 1,
            ],
            [
                'title'          => 'Basketball - Triplo Duplo',
                'description'    => 'Conseguiu um triplo-duplo em uma partida.',
                'points'         => 500,
                'image'          => 'achivment_14.png',
                'rarity'         => 'Epic',
                'required_count' => 1,
            ],

            /*
            |--------------------------------------------------------------------------
            | JOGADOR ACTION - BASKETBALL — Atirador
            |--------------------------------------------------------------------------
            */
 
            [
                'title'          => 'Basketball - Primeiro Três',
                'description'    => 'Converteu sua primeira cesta de 3 pontos.',
                'points'         => 35,
                'image'          => 'achivment_15.png',
                'rarity'         => 'Common',
                'required_count' => 1,
            ],
            [
                'title'          => 'Basketball - Atirador 10',
                'description'    => 'Converteu 10 cestas de 3 pontos.',
                'points'         => 70,
                'image'          => 'achivment_15.png',
                'rarity'         => 'Common',
                'required_count' => 10,
            ],
            [
                'title'          => 'Basketball - Atirador 50',
                'description'    => 'Converteu 50 cestas de 3 pontos.',
                'points'         => 140,
                'image'          => 'achivment_15.png',
                'rarity'         => 'Rare',
                'required_count' => 50,
            ],
            [
                'title'          => 'Basketball - Atirador 100',
                'description'    => 'Converteu 100 cestas de 3 pontos.',
                'points'         => 280,
                'image'          => 'achivment_15.png',
                'rarity'         => 'Rare',
                'required_count' => 100,
            ],
            [
                'title'          => 'Basketball - Atirador 500',
                'description'    => 'Converteu 500 cestas de 3 pontos.',
                'points'         => 1120,
                'image'          => 'achivment_15.png',
                'rarity'         => 'Epic',
                'required_count' => 500,
            ],
            [
                'title'          => 'Basketball - Atirador 1.000',
                'description'    => 'Converteu 1.000 cestas de 3 pontos.',
                'points'         => 20000,
                'image'          => 'achivment_15.png',
                'rarity'         => 'Legendary',
                'required_count' => 1000,
            ],

            /*
            |--------------------------------------------------------------------------
            | JOGADOR ACTION - BASKETBALL — Assistências (Playmaker)
            |--------------------------------------------------------------------------
            */
 
            [
                'title'          => 'Basketball - Primeira Assistência',
                'description'    => 'Faça sua primeira assistência.',
                'points'         => 35,
                'image'          => 'achivment_17.png',
                'rarity'         => 'Common',
                'required_count' => 1,
            ],
            [
                'title'          => 'Basketball - Assistente 25',
                'description'    => 'Faça 25 assistências.',
                'points'         => 70,
                'image'          => 'achivment_17.png',
                'rarity'         => 'Common',
                'required_count' => 25,
            ],
            [
                'title'          => 'Basketball - Assistente 100',
                'description'    => 'Faça 100 assistências.',
                'points'         => 140,
                'image'          => 'achivment_17.png',
                'rarity'         => 'Rare',
                'required_count' => 100,
            ],
            [
                'title'          => 'Basketball - Assistente 250',
                'description'    => 'Faça 250 assistências.',
                'points'         => 280,
                'image'          => 'achivment_17.png',
                'rarity'         => 'Rare',
                'required_count' => 250,
            ],
            [
                'title'          => 'Basketball - Assistente 500',
                'description'    => 'Faça 500 assistências.',
                'points'         => 560,
                'image'          => 'achivment_17.png',
                'rarity'         => 'Epic',
                'required_count' => 500,
            ],
            [
                'title'          => 'Basketball - Assistente 1.000',
                'description'    => 'Faça 1.000 assistências.',
                'points'         => 1120,
                'image'          => 'achivment_17.png',
                'rarity'         => 'Epic',
                'required_count' => 1000,
            ],
            [
                'title'          => 'Basketball - Assistente 2.000',
                'description'    => 'Faça 2.000 assistências.',
                'points'         => 20000,
                'image'          => 'achivment_17.png',
                'rarity'         => 'Legendary',
                'required_count' => 2000,
            ],

            /*
            |--------------------------------------------------------------------------
            | JOGADOR ACTION - BASKETBALL — Defesa / Roubos de Bola (Garras)
            |--------------------------------------------------------------------------
            */
 
            [
                'title'          => 'Basketball - Primeiro Roubo',
                'description'    => 'Realizou seu primeiro roubo de bola.',
                'points'         => 50,
                'image'          => 'achivment_18.png',
                'rarity'         => 'Common',
                'required_count' => 1,
            ],
            [
                'title'          => 'Basketball - Garras 10',
                'description'    => 'Realizou 10 roubos de bola.',
                'points'         => 200,
                'image'          => 'achivment_18.png',
                'rarity'         => 'Common',
                'required_count' => 10,
            ],
            [
                'title'          => 'Basketball - Garras 50',
                'description'    => 'Realizou 50 roubos de bola.',
                'points'         => 400,
                'image'          => 'achivment_18.png',
                'rarity'         => 'Rare',
                'required_count' => 50,
            ],
            [
                'title'          => 'Basketball - Garras 100',
                'description'    => 'Realizou 100 roubos de bola.',
                'points'         => 800,
                'image'          => 'achivment_18.png',
                'rarity'         => 'Rare',
                'required_count' => 100,
            ],
            [
                'title'          => 'Basketball - Garras 200',
                'description'    => 'Realizou 200 roubos de bola.',
                'points'         => 1600,
                'image'          => 'achivment_18.png',
                'rarity'         => 'Epic',
                'required_count' => 200,
            ],
            [
                'title'          => 'Basketball - Garras 500',
                'description'    => 'Realizou 500 roubos de bola.',
                'points'         => 5000,
                'image'          => 'achivment_18.png',
                'rarity'         => 'Epic',
                'required_count' => 500,
            ],
            [
                'title'          => 'Basketball - Rei do Toco',
                'description'    => 'Realizou 1.000 roubos de bola.',
                'points'         => 100000,
                'image'          => 'achivment_18.png',
                'rarity'         => 'Legendary',
                'required_count' => 1000,
            ],

            /*
            |--------------------------------------------------------------------------
            | JOGADOR ACTION - VOLLEYBALL — Pontuação (Atacante)
            |--------------------------------------------------------------------------
            */
 
            [
                'title'          => 'Volleyball - Primeiro Ponto',
                'description'    => 'Marcou seu primeiro ponto',
                'points'         => 50,
                'image'          => 'achivment_21.png',
                'rarity'         => 'Common',
                'required_count' => 1,
            ],
            [
                'title'          => 'Volleyball - Atacante 25',
                'description'    => 'Acumulou 25 pontos.',
                'points'         => 100,
                'image'          => 'achivment_21.png',
                'rarity'         => 'Common',
                'required_count' => 25,
            ],
            [
                'title'          => 'Volleyball - Atacante 100',
                'description'    => 'Acumulou 100 pontos.',
                'points'         => 150,
                'image'          => 'achivment_22.png',
                'rarity'         => 'Common',
                'required_count' => 100,
            ],
            [
                'title'          => 'Volleyball - Atacante 250',
                'description'    => 'Acumulou 250 pontos.',
                'points'         => 300,
                'image'          => 'achivment_22.png',
                'rarity'         => 'Rare',
                'required_count' => 250,
            ],
            [
                'title'          => 'Volleyball - Atacante 500',
                'description'    => 'Acumulou 500 pontos.',
                'points'         => 600,
                'image'          => 'achivment_23.png',
                'rarity'         => 'Rare',
                'required_count' => 500,
            ],
            [
                'title'          => 'Volleyball - Atacante 1.500',
                'description'    => 'Acumulou 1.500 pontos.',
                'points'         => 1200,
                'image'          => 'achivment_23.png',
                'rarity'         => 'Epic',
                'required_count' => 1500,
            ],
            [
                'title'          => 'Volleyball - Lenda da Rede',
                'description'    => 'Acumulou 3.000 pontos.',
                'points'         => 50000,
                'image'          => 'achivment_30.png',
                'rarity'         => 'Legendary',
                'required_count' => 3000,
            ],

            /*
            |--------------------------------------------------------------------------
            | JOGADOR ACTION - VOLLEYBALL — Saque (Sacador / Ace)
            |--------------------------------------------------------------------------
            */
 
            [
                'title'          => 'Volleyball - Primeiro Ace',
                'description'    => 'Realizou seu primeiro ace de saque.',
                'points'         => 50,
                'image'          => 'achivment_24.png',
                'rarity'         => 'Common',
                'required_count' => 1,
            ],
            [
                'title'          => 'Volleyball - Sacador 10',
                'description'    => 'Realizou 10 aces de saque.',
                'points'         => 100,
                'image'          => 'achivment_24.png',
                'rarity'         => 'Common',
                'required_count' => 10,
            ],
            [
                'title'          => 'Volleyball - Sacador 50',
                'description'    => 'Realizou 50 aces de saque.',
                'points'         => 150,
                'image'          => 'achivment_24.png',
                'rarity'         => 'Rare',
                'required_count' => 50,
            ],
            [
                'title'          => 'Volleyball - Sacador 100',
                'description'    => 'Realizou 100 aces de saque.',
                'points'         => 300,
                'image'          => 'achivment_24.png',
                'rarity'         => 'Rare',
                'required_count' => 100,
            ],
            [
                'title'          => 'Volleyball - Sacador 200',
                'description'    => 'Realizou 200 aces de saque.',
                'points'         => 600,
                'image'          => 'achivment_24.png',
                'rarity'         => 'Rare',
                'required_count' => 200,
            ],
            [
                'title'          => 'Volleyball - Sacador 500',
                'description'    => 'Realizou 500 aces de saque.',
                'points'         => 1200,
                'image'          => 'achivment_24.png',
                'rarity'         => 'Epic',
                'required_count' => 500,
            ],
            [
                'title'          => 'Volleyball - Rei do Saque',
                'description'    => 'Realizou 1.000 aces de saque.',
                'points'         => 50000,
                'image'          => 'achivment_24.png',
                'rarity'         => 'Legendary',
                'required_count' => 1000,
            ],

            /*
            |--------------------------------------------------------------------------
            | JOGADOR ACTION - VOLLEYBALL — Bloqueios (Bloqueador)
            |--------------------------------------------------------------------------
            */
 
            [
                'title'          => 'Volleyball - Primeiro Bloqueio',
                'description'    => 'Realizou seu primeiro bloqueio certeiro.',
                'points'         => 100,
                'image'          => 'achivment_25.png',
                'rarity'         => 'Common',
                'required_count' => 1,
            ],
            [
                'title'          => 'Volleyball - Bloqueador 10',
                'description'    => 'Realizou 10 bloqueios certeiros.',
                'points'         => 400,
                'image'          => 'achivment_25.png',
                'rarity'         => 'Common',
                'required_count' => 10,
            ],
            [
                'title'          => 'Volleyball - Bloqueador 50',
                'description'    => 'Realizou 50 bloqueios certeiros.',
                'points'         => 800,
                'image'          => 'achivment_25.png',
                'rarity'         => 'Rare',
                'required_count' => 50,
            ],
            [
                'title'          => 'Volleyball - Bloqueador 100',
                'description'    => 'Realizou 100 bloqueios certeiros.',
                'points'         => 1600,
                'image'          => 'achivment_25.png',
                'rarity'         => 'Rare',
                'required_count' => 100,
            ],
            [
                'title'          => 'Volleyball - Bloqueador 250',
                'description'    => 'Realizou 250 bloqueios certeiros.',
                'points'         => 3200,
                'image'          => 'achivment_25.png',
                'rarity'         => 'Epic',
                'required_count' => 250,
            ],
            [
                'title'          => 'Volleyball - Bloqueador 500',
                'description'    => 'Realizou 500 bloqueios certeiros.',
                'points'         => 5000,
                'image'          => 'achivment_25.png',
                'rarity'         => 'Epic',
                'required_count' => 500,
            ],
            [
                'title'          => 'Volleyball - Muralha da Rede',
                'description'    => 'Realizou 1.000 bloqueios certeiros.',
                'points'         => 100000,
                'image'          => 'achivment_25.png',
                'rarity'         => 'Legendary',
                'required_count' => 1000,
            ],

            /*
            |--------------------------------------------------------------------------
            | JOGADOR ACTION - VOLLEYBALL — Defesas Difíceis (Líbero)
            |--------------------------------------------------------------------------
            */
 
            [
                'title'          => 'Volleyball - Primeira Defesa',
                'description'    => 'Realizou sua primeira defesa difícil.',
                'points'         => 35,
                'image'          => 'achivment_26.png',
                'rarity'         => 'Common',
                'required_count' => 1,
            ],
            [
                'title'          => 'Volleyball - Líbero 25',
                'description'    => 'Realizou 25 defesas difíceis.',
                'points'         => 70,
                'image'          => 'achivment_26.png',
                'rarity'         => 'Common',
                'required_count' => 25,
            ],
            [
                'title'          => 'Volleyball - Líbero 100',
                'description'    => 'Realizou 100 defesas difíceis.',
                'points'         => 140,
                'image'          => 'achivment_26.png',
                'rarity'         => 'Rare',
                'required_count' => 100,
            ],
            [
                'title'          => 'Volleyball - Líbero 250',
                'description'    => 'Realizou 250 defesas difíceis.',
                'points'         => 280,
                'image'          => 'achivment_26.png',
                'rarity'         => 'Rare',
                'required_count' => 250,
            ],
            [
                'title'          => 'Volleyball - Líbero 500',
                'description'    => 'Realizou 500 defesas difíceis.',
                'points'         => 560,
                'image'          => 'achivment_26.png',
                'rarity'         => 'Epic',
                'required_count' => 500,
            ],
            [
                'title'          => 'Volleyball - Líbero 1000',
                'description'    => 'Realizou 1.000 defesas difíceis.',
                'points'         => 1120,
                'image'          => 'achivment_26.png',
                'rarity'         => 'Epic',
                'required_count' => 1000,
            ],
            [
                'title'          => 'Volleyball - Defesa Impecável',
                'description'    => 'Realizou 2.000 defesas difíceis.',
                'points'         => 20000,
                'image'          => 'achivment_26.png',
                'rarity'         => 'Legendary',
                'required_count' => 2000,
            ],

            /*
            |--------------------------------------------------------------------------
            | TÉCNICO ACTION — Pontuação Acumulada
            |--------------------------------------------------------------------------
            */

            [
                'title'          => 'Técnico - Primeira Pontuação',
                'description'    => 'Acumulou 200 pontos como técnico.',
                'points'         => 150,
                'image'          => 'achivment_60.png',
                'rarity'         => 'Common',
                'required_count' => 100,
            ],
            [
                'title'          => 'Técnico - Treinador Promissor',
                'description'    => 'Acumulou 500 pontos como técnico.',
                'points'         => 450,
                'image'          => 'achivment_60.png',
                'rarity'         => 'Common',
                'required_count' => 500,
            ],
            [
                'title'          => 'Técnico - Treinador Experiente',
                'description'    => 'Acumulou 1.500 pontos como técnico.',
                'points'         => 900,
                'image'          => 'achivment_61.png',
                'rarity'         => 'Common',
                'required_count' => 1500,
            ],
            [
                'title'          => 'Técnico - Treinador Competente',
                'description'    => 'Acumulou 4.000 pontos como técnico.',
                'points'         => 1800,
                'image'          => 'achivment_61.png',
                'rarity'         => 'Rare',
                'required_count' => 4000,
            ],
            [
                'title'          => 'Técnico - Treinador de Elite',
                'description'    => 'Acumulou 10.000 pontos como técnico.',
                'points'         => 4000,
                'image'          => 'achivment_62.png',
                'rarity'         => 'Rare',
                'required_count' => 10000,
            ],
            [
                'title'          => 'Técnico - Técnico Master',
                'description'    => 'Acumulou 25.000 pontos como técnico.',
                'points'         => 8500,
                'image'          => 'achivment_62.png',
                'rarity'         => 'Epic',
                'required_count' => 25000,
            ],
            [
                'title'          => 'Técnico - Lenda do Cartola',
                'description'    => 'Acumulou 75.000 pontos como técnico.',
                'points'         => 30000,
                'image'          => 'achivment_63.png',
                'rarity'         => 'Legendary',
                'required_count' => 75000,
            ],

            /*
            |--------------------------------------------------------------------------
            | TÉCNICO — Patrimônio Acumulado
            |--------------------------------------------------------------------------
            */

            [
                'title'          => 'Técnico - Gestor Iniciante',
                'description'    => 'Atingiu um patrimônio de 1.000.',
                'points'         => 450,
                'image'          => 'achivment_64.png',
                'rarity'         => 'Common',
                'required_count' => 1000,
            ],
            [
                'title'          => 'Técnico - Gestor Experiente',
                'description'    => 'Atingiu um patrimônio de 5.000.',
                'points'         => 900,
                'image'          => 'achivment_65.png',
                'rarity'         => 'Common',
                'required_count' => 5000,
            ],
            [
                'title'          => 'Técnico - Gestor Competente',
                'description'    => 'Atingiu um patrimônio de 15.000.',
                'points'         => 1800,
                'image'          => 'achivment_65.png',
                'rarity'         => 'Rare',
                'required_count' => 15000,
            ],
            [
                'title'          => 'Técnico - Gestor de Elite',
                'description'    => 'Atingiu um patrimônio de 50.000.',
                'points'         => 4000,
                'image'          => 'achivment_66.png',
                'rarity'         => 'Rare',
                'required_count' => 50000,
            ],
            [
                'title'          => 'Técnico - Magnata',
                'description'    => 'Atingiu um patrimônio de 150.000.',
                'points'         => 8500,
                'image'          => 'achivment_66.png',
                'rarity'         => 'Epic',
                'required_count' => 150000,
            ],
            [
                'title'          => 'Técnico - Bilionário do Cartola',
                'description'    => 'Atingiu um patrimônio de 500.000.',
                'points'         => 30000,
                'image'          => 'achivment_67.png',
                'rarity'         => 'Legendary',
                'required_count' => 500000,
            ],
            
            /*
            |--------------------------------------------------------------------------
            | ÁRBITRO — partidas
            |--------------------------------------------------------------------------
            */

            [
                'title'          => 'Técnico - Primeira Arbitragem',
                'description'    => 'Apitou sua 1ª partida.',
                'points'         => 150,
                'image'          => 'achivment_60.png',
                'rarity'         => 'Common',
                'required_count' => 100,
            ],
            [
                'title'          => 'Árbitro - Professor Iniciante',
                'description'    => 'Apitou 10 partidas.',
                'points'         => 450,
                'image'          => 'achivment_64.png',
                'rarity'         => 'Common',
                'required_count' => 1000,
            ],
            [
                'title'          => 'Árbitro - Professor Competente',
                'description'    => 'Apitou 50 partidas.',
                'points'         => 900,
                'image'          => 'achivment_65.png',
                'rarity'         => 'Common',
                'required_count' => 5000,
            ],
            [
                'title'          => 'Árbitro - Professor Experiente',
                'description'    => 'Apitou 100 partidas.',
                'points'         => 1800,
                'image'          => 'achivment_65.png',
                'rarity'         => 'Rare',
                'required_count' => 15000,
            ],
            [
                'title'          => 'Árbitro - Professor Pro',
                'description'    => 'Apitou 500 partidas.',
                'points'         => 4000,
                'image'          => 'achivment_66.png',
                'rarity'         => 'Rare',
                'required_count' => 50000,
            ],
            [
                'title'          => 'Árbitro - Professor de Elite',
                'description'    => 'Apitou 1000 partidas.',
                'points'         => 8500,
                'image'          => 'achivment_66.png',
                'rarity'         => 'Epic',
                'required_count' => 150000,
            ],
            [
                'title'          => 'Árbitro - Autoridade',
                'description'    => 'Apitou 5000 partidas.',
                'points'         => 30000,
                'image'          => 'achivment_67.png',
                'rarity'         => 'Legendary',
                'required_count' => 500000,
            ],


            /*
            |--------------------------------------------------------------------------
            | ÁRBITRO — partidas
            |--------------------------------------------------------------------------
            */

            [
                'title'          => 'Técnico - Amarelo',
                'description'    => 'Aplicou seu 1ª cartão amarelo.',
                'points'         => 200,
                'image'          => 'achivment_60.png',
                'rarity'         => 'Common',
                'required_count' => 1,
            ],
            [
                'title'          => 'Técnico - Vermelho',
                'description'    => 'Aplicou seu 1ª cartão vermelho.',
                'points'         => 200,
                'image'          => 'achivment_60.png',
                'rarity'         => 'Common',
                'required_count' => 1,
            ],
        ];

        $n = 1;
        foreach ($achievements as &$achievement) {
            $achievement['image']      = 'achievement_' . $n++ . '.png';
            $achievement['status']     = true;
            $achievement['created_at'] = now();
            $achievement['updated_at'] = now();
            unset($achievement['required_count']);
        }

        DB::table('achievements')->insert($achievements);

        /*
        |--------------------------------------------------------------------------
        | ACHIEVEMENT — ACTIONS PIVOT
        | Maps performance achievements to their tracked action + required count.
        | Onboarding, social, event-participation and técnico achievements are
        | handled by application logic and do not appear here.
        |--------------------------------------------------------------------------
        */

        $actionId      = DB::table('actions')->pluck('id', 'title');
        $achievementId = DB::table('achievements')->pluck('id', 'title');

        $pivots = [

            // ----------------------------------------------------------------
            // FOOTBALL — Artilharia
            // ----------------------------------------------------------------
            ['achievement' => 'Football - Primeiro Gol',    'action' => 'Goal', 'required_count' => 1],
            ['achievement' => 'Football - Artilheiro 10',   'action' => 'Goal', 'required_count' => 10],
            ['achievement' => 'Football - Artilheiro 50',   'action' => 'Goal', 'required_count' => 50],
            ['achievement' => 'Football - Artilheiro 100',  'action' => 'Goal', 'required_count' => 100],
            ['achievement' => 'Football - Artilheiro 200',  'action' => 'Goal', 'required_count' => 200],
            ['achievement' => 'Football - Artilheiro 500',  'action' => 'Goal', 'required_count' => 500],
            ['achievement' => 'Football - Artilheiro 1.000','action' => 'Goal', 'required_count' => 1000],
            ['achievement' => 'Football - Hat-Trick',       'action' => 'Goal', 'required_count' => 3],

            // ----------------------------------------------------------------
            // FOOTBALL — Assistência
            // ----------------------------------------------------------------
            ['achievement' => 'Football - Primeira Assistência', 'action' => 'Assist', 'required_count' => 1],
            ['achievement' => 'Football - Maestro 10',           'action' => 'Assist', 'required_count' => 10],
            ['achievement' => 'Football - Maestro 50',           'action' => 'Assist', 'required_count' => 50],
            ['achievement' => 'Football - Maestro 100',          'action' => 'Assist', 'required_count' => 100],
            ['achievement' => 'Football - Maestro 200',          'action' => 'Assist', 'required_count' => 200],
            ['achievement' => 'Football - Maestro 500',          'action' => 'Assist', 'required_count' => 500],
            ['achievement' => 'Football - Maestro 1.000',        'action' => 'Assist', 'required_count' => 1000],

            // ----------------------------------------------------------------
            // FOOTBALL — Defesa / Goleiro
            // ----------------------------------------------------------------
            ['achievement' => 'Football - Muralha',      'action' => 'CleanSheet', 'required_count' => 5],
            ['achievement' => 'Football - Muralha 10',   'action' => 'CleanSheet', 'required_count' => 10],
            ['achievement' => 'Football - Muralha 50',   'action' => 'CleanSheet', 'required_count' => 50],
            ['achievement' => 'Football - Muralha 100',  'action' => 'CleanSheet', 'required_count' => 100],
            ['achievement' => 'Football - Muralha 200',  'action' => 'CleanSheet', 'required_count' => 200],
            ['achievement' => 'Football - Muralha 500',  'action' => 'CleanSheet', 'required_count' => 500],
            ['achievement' => 'Football - Muralha 1000', 'action' => 'CleanSheet', 'required_count' => 1000],

            // ----------------------------------------------------------------
            // BASKETBALL — Pontuação (cestas acumuladas)
            // ----------------------------------------------------------------
            ['achievement' => 'Basketball - Primeira Cesta',   'action' => 'Point2', 'required_count' => 1],
            ['achievement' => 'Basketball - Cestinha 100',     'action' => 'Point2', 'required_count' => 100],
            ['achievement' => 'Basketball - Cestinha 500',     'action' => 'Point2', 'required_count' => 500],
            ['achievement' => 'Basketball - Cestinha 1.000',   'action' => 'Point2', 'required_count' => 1000],
            ['achievement' => 'Basketball - Cestinha 5.000',   'action' => 'Point2', 'required_count' => 5000],
            ['achievement' => 'Basketball - Cestinha 10.000',  'action' => 'Point2', 'required_count' => 10000],
            ['achievement' => 'Basketball - THE GOAT',         'action' => 'Point2', 'required_count' => 20000],

            // ----------------------------------------------------------------
            // BASKETBALL — Atirador (cestas de 3)
            // ----------------------------------------------------------------
            ['achievement' => 'Basketball - Primeiro Três',  'action' => 'Point3', 'required_count' => 1],
            ['achievement' => 'Basketball - Atirador 10',    'action' => 'Point3', 'required_count' => 10],
            ['achievement' => 'Basketball - Atirador 50',    'action' => 'Point3', 'required_count' => 50],
            ['achievement' => 'Basketball - Atirador 100',   'action' => 'Point3', 'required_count' => 100],
            ['achievement' => 'Basketball - Atirador 500',   'action' => 'Point3', 'required_count' => 500],
            ['achievement' => 'Basketball - Atirador 1.000', 'action' => 'Point3', 'required_count' => 1000],

            // ----------------------------------------------------------------
            // BASKETBALL — Assistências (Playmaker)
            // ----------------------------------------------------------------
            ['achievement' => 'Basketball - Primeira Assistência', 'action' => 'BasketAssist', 'required_count' => 1],
            ['achievement' => 'Basketball - Assistente 25',        'action' => 'BasketAssist', 'required_count' => 25],
            ['achievement' => 'Basketball - Assistente 100',       'action' => 'BasketAssist', 'required_count' => 100],
            ['achievement' => 'Basketball - Assistente 250',       'action' => 'BasketAssist', 'required_count' => 250],
            ['achievement' => 'Basketball - Assistente 500',       'action' => 'BasketAssist', 'required_count' => 500],
            ['achievement' => 'Basketball - Assistente 1.000',     'action' => 'BasketAssist', 'required_count' => 1000],
            ['achievement' => 'Basketball - Assistente 2.000',     'action' => 'BasketAssist', 'required_count' => 2000],

            // ----------------------------------------------------------------
            // BASKETBALL — Roubos de Bola (Garras)
            // ----------------------------------------------------------------
            ['achievement' => 'Basketball - Primeiro Roubo', 'action' => 'Steal', 'required_count' => 1],
            ['achievement' => 'Basketball - Garras 10',      'action' => 'Steal', 'required_count' => 10],
            ['achievement' => 'Basketball - Garras 50',      'action' => 'Steal', 'required_count' => 50],
            ['achievement' => 'Basketball - Garras 100',     'action' => 'Steal', 'required_count' => 100],
            ['achievement' => 'Basketball - Garras 200',     'action' => 'Steal', 'required_count' => 200],
            ['achievement' => 'Basketball - Garras 500',     'action' => 'Steal', 'required_count' => 500],
            ['achievement' => 'Basketball - Rei do Toco',    'action' => 'Steal', 'required_count' => 1000],

            // ----------------------------------------------------------------
            // VOLLEYBALL — Pontuação de Ataque
            // ----------------------------------------------------------------
            ['achievement' => 'Volleyball - Primeiro Ponto',  'action' => 'Point', 'required_count' => 1],
            ['achievement' => 'Volleyball - Atacante 25',     'action' => 'Point', 'required_count' => 25],
            ['achievement' => 'Volleyball - Atacante 100',    'action' => 'Point', 'required_count' => 100],
            ['achievement' => 'Volleyball - Atacante 250',    'action' => 'Point', 'required_count' => 250],
            ['achievement' => 'Volleyball - Atacante 500',    'action' => 'Point', 'required_count' => 500],
            ['achievement' => 'Volleyball - Atacante 1.500',  'action' => 'Point', 'required_count' => 1500],
            ['achievement' => 'Volleyball - Lenda da Rede',   'action' => 'Point', 'required_count' => 3000],

            // ----------------------------------------------------------------
            // VOLLEYBALL — Saque (Ace)
            // ----------------------------------------------------------------
            ['achievement' => 'Volleyball - Primeiro Ace', 'action' => 'Ace', 'required_count' => 1],
            ['achievement' => 'Volleyball - Sacador 10',   'action' => 'Ace', 'required_count' => 10],
            ['achievement' => 'Volleyball - Sacador 50',   'action' => 'Ace', 'required_count' => 50],
            ['achievement' => 'Volleyball - Sacador 100',  'action' => 'Ace', 'required_count' => 100],
            ['achievement' => 'Volleyball - Sacador 200',  'action' => 'Ace', 'required_count' => 200],
            ['achievement' => 'Volleyball - Sacador 500',  'action' => 'Ace', 'required_count' => 500],
            ['achievement' => 'Volleyball - Rei do Saque', 'action' => 'Ace', 'required_count' => 1000],

            // ----------------------------------------------------------------
            // VOLLEYBALL — Bloqueios
            // ----------------------------------------------------------------
            ['achievement' => 'Volleyball - Primeiro Bloqueio', 'action' => 'Block', 'required_count' => 1],
            ['achievement' => 'Volleyball - Bloqueador 10',     'action' => 'Block', 'required_count' => 10],
            ['achievement' => 'Volleyball - Bloqueador 50',     'action' => 'Block', 'required_count' => 50],
            ['achievement' => 'Volleyball - Bloqueador 100',    'action' => 'Block', 'required_count' => 100],
            ['achievement' => 'Volleyball - Bloqueador 250',    'action' => 'Block', 'required_count' => 250],
            ['achievement' => 'Volleyball - Bloqueador 500',    'action' => 'Block', 'required_count' => 500],
            ['achievement' => 'Volleyball - Muralha da Rede',   'action' => 'Block', 'required_count' => 1000],

            // ----------------------------------------------------------------
            // VOLLEYBALL — Defesas Difíceis (Líbero)
            // ----------------------------------------------------------------
            ['achievement' => 'Volleyball - Primeira Defesa',    'action' => 'DefensiveSave', 'required_count' => 1],
            ['achievement' => 'Volleyball - Líbero 25',          'action' => 'DefensiveSave', 'required_count' => 25],
            ['achievement' => 'Volleyball - Líbero 100',         'action' => 'DefensiveSave', 'required_count' => 100],
            ['achievement' => 'Volleyball - Líbero 250',         'action' => 'DefensiveSave', 'required_count' => 250],
            ['achievement' => 'Volleyball - Líbero 500',         'action' => 'DefensiveSave', 'required_count' => 500],
            ['achievement' => 'Volleyball - Líbero 1000',        'action' => 'DefensiveSave', 'required_count' => 1000],
            ['achievement' => 'Volleyball - Defesa Impecável',   'action' => 'DefensiveSave', 'required_count' => 2000],
        ];

        $rows = [];
        foreach ($pivots as $p) {
            $rows[] = [
                'achievement_id' => $achievementId[$p['achievement']],
                'action_id'      => $actionId[$p['action']],
                'required_count' => $p['required_count'],
                'created_at'     => now(),
                'updated_at'     => now(),
            ];
        }

        DB::table('achievement_actions')->insert($rows);

        /*
        |--------------------------------------------------------------------------
        | ACHIEVEMENT — TASKS PIVOT
        | Maps achievements based on task completion to their task(s) + required count.
        | Performance achievements tracked via actions do not appear here.
        |--------------------------------------------------------------------------
        */

        $taskId = DB::table('tasks')->pluck('id', 'title');

        $taskPivots = [

            // ----------------------------------------------------------------
            // GERAL — Onboarding (completar configurações de conta/perfil)
            // ----------------------------------------------------------------
            ['achievement' => 'Geral - Perfil Completo',   'task' => 'Informações de Conta',      'required_count' => 1],

            ['achievement' => 'Jogador licenciado',        'task' => 'Definir posição favorita',  'required_count' => 1],
            ['achievement' => 'Jogador licenciado',        'task' => 'Definir melhor lado',        'required_count' => 1],
            ['achievement' => 'Jogador licenciado',        'task' => 'Definir Arquétipo',          'required_count' => 1],
            ['achievement' => 'Jogador licenciado',        'task' => 'Definir Nº',                 'required_count' => 1],

            ['achievement' => 'Técnico licenciado',        'task' => 'Definir equipe',             'required_count' => 1],
            ['achievement' => 'Técnico licenciado',        'task' => 'Definir emblema',            'required_count' => 1],
            ['achievement' => 'Técnico licenciado',        'task' => 'Definir Kit',                'required_count' => 1],

            // ----------------------------------------------------------------
            // EVENTO — Inicialização (participar / criar peladas)
            // ----------------------------------------------------------------
            ['achievement' => 'Estreante',            'task' => 'Participar de uma pelada', 'required_count' => 1],
            ['achievement' => 'Peladeiro Raiz',       'task' => 'Participar de uma pelada', 'required_count' => 3],
            ['achievement' => 'Organizador Estreante','task' => 'Criar evento',             'required_count' => 1],
            ['achievement' => 'Organizador Raiz',     'task' => 'Criar evento',             'required_count' => 3],

            // ----------------------------------------------------------------
            // EVENTO — Participação em partidas
            // ----------------------------------------------------------------
            ['achievement' => 'Novo Começo',       'task' => 'Participar de partida', 'required_count' => 1],
            ['achievement' => 'Frequentador',      'task' => 'Participar de partida', 'required_count' => 5],
            ['achievement' => 'Titular',           'task' => 'Participar de partida', 'required_count' => 10],
            ['achievement' => 'Indispensável',     'task' => 'Participar de partida', 'required_count' => 50],
            ['achievement' => 'Centenário',        'task' => 'Participar de partida', 'required_count' => 100],
            ['achievement' => 'Veternano',         'task' => 'Participar de partida', 'required_count' => 300],
            ['achievement' => 'Craque',            'task' => 'Participar de partida', 'required_count' => 500],
            ['achievement' => 'Lenda das Peladas', 'task' => 'Participar de partida', 'required_count' => 1000],

            // ----------------------------------------------------------------
            // EVENTO — Invicto (vitórias consecutivas — lógica na aplicação)
            // ----------------------------------------------------------------
            ['achievement' => 'Invicto 5',   'task' => 'Vitória', 'required_count' => 5],
            ['achievement' => 'Invicto 10',  'task' => 'Vitória', 'required_count' => 10],
            ['achievement' => 'Invicto 30',  'task' => 'Vitória', 'required_count' => 30],
            ['achievement' => 'Invicto 50',  'task' => 'Vitória', 'required_count' => 50],
            ['achievement' => 'Invicto 100', 'task' => 'Vitória', 'required_count' => 100],

            // ----------------------------------------------------------------
            // GERAL — Social (convites e amizades)
            // ----------------------------------------------------------------
            ['achievement' => 'Primeiro Convite',     'task' => 'Convidar amigo', 'required_count' => 1],
            ['achievement' => 'Amigo de Verdade',     'task' => 'Convidar amigo', 'required_count' => 1],
            ['achievement' => 'Conector',             'task' => 'Convidar amigo', 'required_count' => 3],
            ['achievement' => 'Amigo da vizinhaça',   'task' => 'Convidar amigo', 'required_count' => 5],
            ['achievement' => 'Embaixador',           'task' => 'Convidar amigo', 'required_count' => 10],

            // ----------------------------------------------------------------
            // ÁRBITRO — partidas apitadas
            // ----------------------------------------------------------------
            ['achievement' => 'Técnico - Primeira Arbitragem', 'task' => 'Apitar', 'required_count' => 1],
            ['achievement' => 'Árbitro - Professor Iniciante', 'task' => 'Apitar', 'required_count' => 10],
            ['achievement' => 'Árbitro - Professor Competente','task' => 'Apitar', 'required_count' => 50],
            ['achievement' => 'Árbitro - Professor Experiente','task' => 'Apitar', 'required_count' => 100],
            ['achievement' => 'Árbitro - Professor de Elite',  'task' => 'Apitar', 'required_count' => 500],
            ['achievement' => 'Árbitro - Autoridade',          'task' => 'Apitar', 'required_count' => 5000],
        ];

        $taskRows = [];
        foreach ($taskPivots as $p) {
            $taskRows[] = [
                'achievement_id' => $achievementId[$p['achievement']],
                'task_id'        => $taskId[$p['task']],
                'required_count' => $p['required_count'],
                'created_at'     => now(),
                'updated_at'     => now(),
            ];
        }

        DB::table('achievement_tasks')->insert($taskRows);
    }
}