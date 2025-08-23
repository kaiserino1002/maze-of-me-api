<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\NodeController;
use App\Http\Controllers\AnalysisController;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::post('/logout', function (Request $request) {
    auth()->guard('web')->logout();
});

Route::middleware('auth:sanctum')->group(function () {
  Route::get('/nodes', [NodeController::class, 'index']);
  Route::post('/node', [NodeController::class, 'store']);
  Route::post('/analyze', [AnalysisController::class, 'analyze']);
});
