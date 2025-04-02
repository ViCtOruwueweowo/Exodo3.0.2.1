<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json(['error' => 'No autenticado'], 401);
            }

            // Si el usuario tiene role_id = 3, solo permitir GET
            if ($user->role_id == 3 && !$request->isMethod('GET')) {
                return response()->json(['error' => 'Acceso denegado. Solo lectura permitida'], 403);
            }

            // Verificar si el rol del usuario está en la lista de roles permitidos
            if (!in_array($user->role_id, $roles)) {
                return response()->json(['error' => 'Acceso denegado'], 403);
            }

            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token inválido o expirado', 'message' => $e->getMessage()], 401);
        }
    }

}
