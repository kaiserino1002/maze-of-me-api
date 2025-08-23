<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AnalysisController extends Controller
{
  public function analyze(Request $request)
  {
    $validated = $request->validate([
      'text' => 'required|string',
    ]);

    $response = Http::post(config('services.analyzer.url') . '/analyze', [
      'text' => $validated['text'],
    ]);

    if ($response->failed()) {
      return response()->json([
        'error' => 'Failed to analyze text',
        'details' => $response->body(),
      ], 500);
    }

    return $response->json();
  }
}
