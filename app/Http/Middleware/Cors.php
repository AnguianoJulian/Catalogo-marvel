<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    public function handle($request, Closure $next)
    {
        $allowedOrigins = [
            'https://catalogo-marvel-frontend.vercel.app', // 👈 dominio Vercel correcto
            'https://catalogo-marvel-frontend2.onrender.com', // Render frontend anterior (por si acaso)
            'http://localhost:4200', // desarrollo local
        ];

        $origin = $request->headers->get('Origin');

        if ($origin && in_array($origin, $allowedOrigins)) {
            header("Access-Control-Allow-Origin: $origin");
        } else {
            // Valor por defecto si no coincide ningún dominio
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
