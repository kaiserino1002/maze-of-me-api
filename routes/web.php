<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Auth\GoogleAuthController;

Route::get('/sanctum/csrf-cookie', [\Laravel\Sanctum\Http\Controllers\CsrfCookieController::class, 'show']);

Route::get('auth/redirect/google', [GoogleAuthController::class, 'redirectToGoogle']);
Route::get('auth/callback/google', [GoogleAuthController::class, 'handleGoogleCallback']);

Route::get('/{any}', function () {
    return view('app'); // app.blade.php
})->where('any', '^(?!api).*$'); 