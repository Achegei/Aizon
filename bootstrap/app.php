<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        /**
         * Named route middleware aliases
         * Use as ->middleware('admin') in routes
         */
        $middleware->alias([
            'admin'    => \App\Http\Middleware\AdminMiddleware::class,
            'creator'  => \App\Http\Middleware\CreatorMiddleware::class,
            'employer' => \App\Http\Middleware\EmployerMiddleware::class,
            'role'     => \App\Http\Middleware\RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // optional custom exception handling
    })
    ->create();
