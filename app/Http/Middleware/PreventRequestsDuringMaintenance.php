<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * Las rutas que deben estar disponibles durante el modo mantenimiento.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
