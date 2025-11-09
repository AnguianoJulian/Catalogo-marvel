<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    public function handle($request, Closure $next)
    {
        $allowedOrigins = [
            'https://catalogo-marvel-frontend2.onrender.com',
            'https://catalogo-marvel-frontend.vercel.app', // 👈 nuevo dominio
            'http://localhost:4200', // para desarrollo local
        ];

        $origin = $request->headers->get('Origin');

        if ($origin && in_array($origin, $allowedOrigins)) {
            header("Access-Control-Allow-Origin: $origin");
        } else {
            // Si el origen no está permitido, podrías omitir el header o registrar un log
            header("Access-Control-Allow-Origin: https://catalogo-marvel-frontend.vercel.app");
        }

        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
        header("Access-Control-Allow-Credentials: true");

        if ($request->getMethod() === "OPTIONS") {
            return response()->json('OK', 200);
        }

        return $next($request);
    }
}
