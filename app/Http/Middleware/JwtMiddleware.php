<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Intenta obtener y validar el token
            $user = JWTAuth::parseToken()->authenticate();

            // Si no se encuentra un usuario, se regresa una respuesta de no autorizado
            if (!$user) {
                return response()->json(['error' => 'No autorizado'], 401);
            }
        } catch (JWTException $e) {
            // Si ocurre un error (token no proporcionado o inválido)
            return response()->json(['error' => 'Token invalido o no proporcionado'], 401);
        }

        // Si el token es válido, pasa a la siguiente solicitud
        return $next($request);
    }
}
