<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Node;

class NodeController extends Controller
{
  public function index(Request $request)
  {
    return Node::where('user_id', $request->user()->id)->get();
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'text' => 'required|string',
    ]);

    $response = Http::post(config('services.analyzer.url') . '/analyze', [
      'text' => $validated['text'],
    ]);

    $analysis = $response->ok() ? $response->json() : null;

    $node = Node::create([
      'user_id'  => $request->user()->id,
      'text'     => $validated['text'],
      'analysis' => $analysis,
    ]);

    return response()->json([
      'message' => 'Node created successfully',
      'data'    => $node,
    ]);
  }
}
