<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    public function handle($request, Closure $next)
    {
        // Dominios permitidos
        $allowedOrigins = [
            'https://catalogo-marvel-frontend.vercel.app',
            'https://catalogo-marvel-frontend2.onrender.com',
            'http://localhost:4200',
        ];

        $origin = $request->headers->get('Origin');

        if ($origin && in_array($origin, $allowedOrigins)) {
            header("Access-Control-Allow-Origin: {$origin}");
        } else {
            // Fallback mientras pruebas (puedes quitar el '*' en producción si quieres más control)
            header("Access-Control-Allow-Origin: *");
        }

        header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, X-CSRF-TOKEN");
        header("Access-Control-Allow-Credentials: true");

        // Responder a preflight
        if ($request->getMethod() === "OPTIONS") {
            return response()->json('OK', 200);
        }

        return $next($request);
    }
}
