<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Staff; // Asegúrate de importar el modelo Staff

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
            // Intentamos obtener al usuario autenticado mediante el token JWT
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                // Si no se encuentra un usuario, redirigimos al login
                return redirect()->route('staff.login');
            }

            // Verificación de roles
            $role = $user->role; // Asumiendo que el campo `role` está en la tabla `staff`

            // Rutas de administrador (acceso total)
            if ($role === 'Administrador') {
                return $next($request);  // Si es administrador, permite continuar
            }

            // Rutas de cliente (acceso a películas y lo relacionado)
            if ($role === 'Cliente') {
                // Verificar si está intentando acceder a algo fuera de su alcance
                if ($this->isNotAllowedClientRoute($request)) {
                    return redirect()->route('staff.login');  // Redirigir si intenta acceder a una ruta no permitida
                }
                return $next($request);
            }

            // Rutas de invitado (solo lectura)
            if ($role === 'Invitado') {
                // Verificar si está intentando hacer alguna acción que no sea solo lectura
                if ($this->isNotAllowedGuestRoute($request)) {
                    return redirect()->route('staff.login');  // Redirigir si intenta hacer algo no permitido
                }
                return $next($request);
            }

            // Si el rol no es válido, redirigir al login
            return redirect()->route('staff.login');
            
        } catch (JWTException $e) {
            // Si ocurre algún error con el token, redirigir al login
            return redirect()->route('staff.login');
        }
    }

    /**
     * Determina si la ruta no está permitida para un cliente.
     *
     * @param Request $request
     * @return bool
     */
    protected function isNotAllowedClientRoute(Request $request)
    {
        // Aquí puedes agregar las rutas que los clientes no pueden acceder
        $notAllowedRoutes = [
            'films.create', 'films.edit', 'films.destroy', // Ejemplo: los clientes no pueden crear, editar o borrar películas
            'categories.create', 'categories.edit', 'categories.destroy', // Similar para categorías
            // Agrega más rutas aquí según sea necesario
        ];

        return in_array($request->route()->getName(), $notAllowedRoutes);
    }

    /**
     * Determina si la ruta no está permitida para un invitado (solo lectura).
     *
     * @param Request $request
     * @return bool
     */
    protected function isNotAllowedGuestRoute(Request $request)
    {
        // Los invitados solo pueden ver contenido, no modificarlo
        $notAllowedRoutes = [
            'films.create', 'films.edit', 'films.store', 'films.update', 'films.destroy',  // Invitado no puede modificar películas
            'categories.create', 'categories.edit', 'categories.store', 'categories.update', 'categories.destroy', // Similar para categorías
            // Agregar más rutas modificables aquí
        ];

        return in_array($request->route()->getName(), $notAllowedRoutes);
    }
}

