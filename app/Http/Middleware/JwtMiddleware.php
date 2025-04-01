<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtMiddleware
{
    /**
     * Maneja una solicitud entrante.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            // Intentar obtener el token desde la cookie
            $token = $request->cookie('jwt_token');

            if (!$token) {
                return redirect()->route('staff.login');
            }

            // Establecer el token manualmente en JWTAuth
            JWTAuth::setToken($token);

            // Intentamos autenticar al usuario con el token
            if (!JWTAuth::parseToken()->authenticate()) {
                return redirect()->route('staff.login');
            }

            return $next($request);
        } catch (JWTException $e) {
            // Si ocurre una excepción de JWT, redirigir al login
            return redirect()->route('staff.login');
        }
    }
}
