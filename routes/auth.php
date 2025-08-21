<?php

use App\Http\Controllers\Auth\GoogleLoginController;

Route::middleware('guest')->group(function () {
    Route::get('auth/google', [GoogleLoginController::class, 'redirectToGoogle'])
        ->name('auth.google');

    Route::get('auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])
        ->name('auth.google.callbck');
});