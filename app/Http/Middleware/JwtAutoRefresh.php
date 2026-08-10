<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;

class JwtAutoRefresh
{
    // CONSTANTE DE TEMPO DE REFRESH DE TOKEN (EM MINUTOS)
    private const REFRESH_THRESHOLD_MINUTES = 15;
    // Flag para evitar refresh recursivo
    private const REFRESHED_FLAG = '_jwt_refreshed';

    public function handle(Request $request, Closure $next)
    {
        // PREVENIR REFRESH RECURSIVO
        if ($request->attributes->get(self::REFRESHED_FLAG)) {
            return $next($request);
        }

        try {
            // PARSE DO TOKEN NA REQUISIÇÃO
            $token = JWTAuth::parseToken();

        } catch (JWTException $e) {
            return response()->json(['message' => 'Token ausente ou mal formatado.'], 401);
        }

        try {
            // TENTAR AUTENTICAR COM O TOKEN ATUAL
            $user = $token->authenticate();

            if (!$user) {
                return response()->json(['message' => 'Usuário não encontrado.'], 401);
            }

            // VERIFICAR SE TOKEN ESTÁ PRÓXIMO DE EXPIRAR (RENOVAÇÃO PREVENTIVA)
            $shouldRefresh = $this->shouldRefreshToken($token);

            // CONTINUAR A REQUISIÇÃO
            $response = $next($request);

            // SE PRECISA RENOVAR, FAZER REFRESH E RETORNAR COM NOVO TOKEN
            if ($shouldRefresh) {
                return $this->attachRefreshedToken($response, $token);
            }

            return $response;

        } catch (TokenExpiredException $e) {
            // TOKEN EXPIRADO - TENTAR RENOVAR
            Log::channel('auth')->info("[Token expirado] Tentando renovar");
            return $this->refreshExpiredToken($request, $next);

        } catch (TokenInvalidException $e) {
            Log::channel('auth')->warning("[Token inválido]", ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Token inválido. Faça login novamente.'], 401);

        } catch (JWTException $e) {
            Log::channel('auth')->error("[Erro JWT Middleware]", ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Erro de autenticação.'], 401);
        }
    }

    /**
     * FUNÇÃO DE VERIFICAÇÃO SE TOKEN DEVE SER RENOVADO
     */
    private function shouldRefreshToken($token): bool
    {
        try {
            $payload = $token->getPayload();
            $expiration = $payload->get('exp');
            $now = now()->timestamp;
            $minutesLeft = ($expiration - $now) / 60;

            Log::channel('auth')->debug("[Token TTL check]", [
                'minutes_left' => round($minutesLeft, 2),
                'threshold' => self::REFRESH_THRESHOLD_MINUTES
            ]);

            return $minutesLeft < self::REFRESH_THRESHOLD_MINUTES;

        } catch (JWTException $e) {
            Log::channel('auth')->warning("[Erro ao verificar expiração do token]", [
                'message' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * RENOVAR TOKEN EXPIRADO
     */
    private function refreshExpiredToken(Request $request, Closure $next)
    {
        try {
            // INVALIDAR O CONTEXTO ATUAL E FAZER REFRESH
            $newToken = JWTAuth::refresh();

            // CONFIGURAR O NOVO TOKEN NO JWTAUTH
            JWTAuth::setToken($newToken);
            
            // REAUTENTICAR COM O NOVO TOKEN
            $user = JWTAuth::authenticate();

            if (!$user) {
                Log::channel('auth')->error("[Falha ao reautenticar após refresh]");
                return response()->json(['message' => 'Não foi possível reautenticar.'], 401);
            }

            // MARCAR COMO REFRESHED PARA EVITAR RECURSÃO
            $request->attributes->set(self::REFRESHED_FLAG, true);

            // CONTINUAR A REQUISIÇÃO COM O NOVO TOKEN
            $response = $next($request);

            // RETORNAR COM NOVO TOKEN NOS HEADERS
            return $response->withHeaders([
                'Authorization' => 'Bearer ' . $newToken->get(),
                'X-Token-Refreshed' => 'true',
            ]);

        } catch (TokenExpiredException $e) {
            // REFRESH TOKEN TAMBÉM EXPIROU
            Log::channel('auth')->warning("[Refresh token expirado - Sessão finalizada]");
            return response()->json([
                'message' => 'Sessão encerrada. Faça login novamente.',
                'session_expired' => true,
            ], 401);

        } catch (JWTException $e) {
            Log::channel('auth')->error("[Erro ao renovar token expirado]", [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Erro ao renovar sessão.'], 401);
        }
    }

    /**
     * ANEXAR NOVO TOKEN À RESPOSTA (RENOVAÇÃO PREVENTIVA)
     */
    private function attachRefreshedToken($response, $token)
    {
        try {
            $newToken = $token->refresh();

            Log::channel('auth')->debug("[Token renovado preventivamente]", [
                'new_token_partial' => substr($newToken->get(), 0, 20) . '...'
            ]);

            return $response->withHeaders([
                'Authorization' => 'Bearer ' . $newToken->get(),
                'X-Token-Refreshed' => 'true',
            ]);

        } catch (JWTException $e) {
            Log::channel('auth')->warning("[Falha na renovação preventiva de token]", [
                'message' => $e->getMessage()
            ]);
            // Não bloqueia a resposta - apenas loga o aviso
            return $response;
        }
    }
}