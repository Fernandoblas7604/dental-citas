<?php
use App\Http\Middleware\EnsureDentist;
use Illuminate\Foundation\Configuration\Middleware;

// Dentro de la configuración de la aplicación:
$middleware->alias([
    'ensure.dentist' => EnsureDentist::class,
]);
