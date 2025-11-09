<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    public function handle($request, Closure $next)
    {
        $allowedOrigins = [
            'https://catalogo-marvel-frontend2.onrender.com',
            'https://catalogo-marvel-frontend.vercel.app',
            'http://localhost:4200',
        ];

        $origin = $request->headers->get('Origin');

        if ($origin && in_array($origin, $allowedOrigins)) {
            header("Access-Control-Allow-Origin: $origin");
        } else {
            // No establezcas un dominio fijo aquí — mejor no enviar encabezado si no coincide
            header("Access-Control-Allow-Origin: *");
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
