<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Middleware global
     */
    protected $middleware = [
        \Illuminate\Http\Middleware\HandleCors::class,
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * Grupos de middleware
     */
    protected $middlewareGroups = [
        'web' => [
            //
        ],

        'api' => [
            \Illuminate\Http\Middleware\HandleCors::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Middleware individuales
     */
    protected $routeMiddleware = [
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ];

    /**
     * Soporte para proxies (Render usa proxy inverso)
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
