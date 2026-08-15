<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\HomeService;

class HomeController extends Controller
{
    /** 
    * EVENTOS - RECOMENDADOS
    *
    * @param Request: Array multidimensional com parametros de filtragem;
    * @return Array || []: Array Multidimencional com dados para home page;
    */
    public function home(Request $request){
        try {
            $homeService = new HomeService();
            $resp = [
                "toYou" => [
                    "title" =>  "Para você",
                    "items" =>  $homeService->recommended()
                ],
                "nearby" => [
                    "title" =>  "Perto de você",
                    "items" =>  $homeService->nearby($request->all())
                ],
                "popular" => [
                    "title" =>  "Populares",
                    "items" =>  $homeService->popular()
                ],
                "live" => [
                    "title" =>  "Ao vivo",
                    "items" =>  $homeService->live()
                ],
                "today" => [
                    "title" =>  "Hoje",
                    "items" =>  $homeService->today()
                ],
                "friends" => [
                    "title" =>  "Talvez você conheça",
                    "items" =>  $homeService->friends($request->all())
                ]
            ];
            return response()->json($resp, 200); 
        } catch (\Throwable $th) {
            //CAPTURAR ERRO E ENVIAR PARA O LOG
            Log::channel('register')->error("[Erro ao buscar dados][Home]", ['[message]' => $th->getMessage(), '[error]' => $th->getTraceAsString()]);
            return response()->json(['message' => 'Houve um erro ao buscar dados, tente novamente'], 400); 
        }
    }
}
