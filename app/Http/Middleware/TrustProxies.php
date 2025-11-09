<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * Los proxies de confianza.
     *
     * Render usa un proxy inverso, así que usamos '*'
     */
    protected $proxies = '*';

    /**
     * Los encabezados que deben ser confiables.
     */
    protected $headers = [
        Request::HEADER_FORWARDED => null,
        Request::HEADER_X_FORWARDED_FOR => 'X_FORWARDED_FOR',
        Request::HEADER_X_FORWARDED_HOST => 'X_FORWARDED_HOST',
        Request::HEADER_X_FORWARDED_PORT => 'X_FORWARDED_PORT',
        Request::HEADER_X_FORWARDED_PROTO => 'X_FORWARDED_PROTO',
    ];
}
