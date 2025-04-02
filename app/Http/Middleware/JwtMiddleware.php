<?php

namespace App\Http\Middleware;

use Tymon\JWTAuth\Facades\JWTAuth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Intentar obtener el token desde las cabeceras
            $token = $request->bearerToken();

            // Si no hay token en el header, intentar obtenerlo de la cookie
            if (!$token) {
                $token = $request->cookie('jwt_token');
                
                // Si el token existe en la cookie, agregarlo al header Authorization
                if ($token) {
                    $request->headers->set('Authorization', 'Bearer ' . $token);
                }
            }

            if (!$token) {
                return response()->json(['error' => 'Token no encontrado'], Response::HTTP_UNAUTHORIZED);
            }

            // Establecer el token para la autenticación
            JWTAuth::setToken($token);
            $user = JWTAuth::authenticate();

            if (!$user) {
                return response()->json(['error' => 'Usuario no autenticado'], Response::HTTP_UNAUTHORIZED);
            }

            return $next($request);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['error' => 'Token expirado'], Response::HTTP_UNAUTHORIZED);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => 'Token inválido'], Response::HTTP_UNAUTHORIZED);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Error al procesar el token'], Response::HTTP_UNAUTHORIZED);
        }
    }
}
