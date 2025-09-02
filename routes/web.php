<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
  return response()->json(['message' => 'Maze of Me API is running']);
});

Route::get('/test-analyzer', function () {
  $response = Http::post(config('services.analyzer.url') . '/analyze', [
    'text' => 'Hello from Laravel!',
  ]);

  return $response->json();
});
