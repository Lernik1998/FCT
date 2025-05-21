<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        channels: __DIR__ . '/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Se aplican a todas las rutas
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
            // \App\Http\Middleware\RoleMiddleware::class, // Middleware de roles, no empleado
            \App\Http\Middleware\RoleUser::class,
            \App\Http\Middleware\RoleAdmin::class,
            \App\Http\Middleware\RoleTrainer::class,
        ]);

    })->withExceptions(function (Exceptions $exceptions) {

    })->create();
