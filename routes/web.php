<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

// Route::get('/check-auth', function (\Illuminate\Http\Request $request) {
//     \Log::info('Session ID: ' . session()->getId());
//     \Log::info('Auth check: ' . json_encode(auth()->check()));
//     \Log::info('User: ' . json_encode(auth()->user()));

//     return response()->json([
//         'check' => auth()->check(),
//         'user' => auth()->user(),
//         'session_id' => session()->getId(),
//         'cookie' => $request->cookie(),
//     ]);
// });

Route::get('/', function () {
    return view('welcome');
});
