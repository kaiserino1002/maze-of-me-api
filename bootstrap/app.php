<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Illuminate\Http\Middleware\HandleCors;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // webグループにSanctumのStateful認証を追加（念のため）
        $middleware->prependToGroup(
            'web',
            EnsureFrontendRequestsAreStateful::class
        );
        // apiグループにもSanctumのStateful認証を追加（これが重要！）
        $middleware->prependToGroup(
            'api',
            EnsureFrontendRequestsAreStateful::class
        );
        // apiグループにCORSも追加（未指定の場合は明示的に入れてOK）
        $middleware->prependToGroup(
            'api',
            HandleCors::class
        );
        $middleware->web();
        $middleware->api();
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
