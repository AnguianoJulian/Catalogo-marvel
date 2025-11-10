<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Si el usuario ya está autenticado, simplemente continúa la solicitud (no redirige).
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // En una API, no redirigimos, solo devolvemos una respuesta JSON
                return response()->json(['message' => 'Ya estás autenticado.'], 200);
            }
        }

        return $next($request);
    }
}
