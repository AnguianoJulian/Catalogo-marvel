<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Middleware global
     */
    protected $middleware = [
        \App\Http\Middleware\Cors::class, // <- ejecuta CORS siempre
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * Grupos de middleware
     */
    protected $middlewareGroups = [
        'web' => [
            // si usas sesiones/cookies, agrega aquí
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Middleware individuales (por ruta)
     */
    protected $routeMiddleware = [
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ];

    /**
     * Proxies (útil en Render)
     */
    protected $proxies = '*';

    protected $headers = [
        \Illuminate\Http\Request::HEADER_FORWARDED => null,
        \Illuminate\Http\Request::HEADER_X_FORWARDED_FOR => 'X_FORWARDED_FOR',
        \Illuminate\Http\Request::HEADER_X_FORWARDED_HOST => 'X_FORWARDED_HOST',
        \Illuminate\Http\Request::HEADER_X_FORWARDED_PORT => 'X_FORWARDED_PORT',
        \Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO => 'X_FORWARDED_PROTO',
    ];
}
