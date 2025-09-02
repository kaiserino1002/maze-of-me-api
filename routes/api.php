<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\NodeController;
use App\Http\Controllers\AnalysisController;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  if (config('app.auth_disabled')) {
    // Preview 環境 → 即テストユーザー返却
    return response()->json([
      'id' => 0,
      'name' => 'Preview User',
      'email' => 'preview@maze-of-me.test',
    ]);
  }

  // 本番・開発環境 → Google 認証済みユーザー
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
