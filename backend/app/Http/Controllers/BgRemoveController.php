<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class BgRemoveController extends Controller
{
public function remove(Request $request)
{
    if (!$request->hasFile('image')) {
        return response()->json(['error' => 'No image uploaded'], 400);
    }

    $image = $request->file('image');
    $imageContent = file_get_contents($image->getRealPath());

    $response = Http::withHeaders([
        'Authorization' => 'd8acc222-3899-4a96-8dd7-3032001d4d37',
        'Content-Type' => 'application/octet-stream',
    ])->withBody($imageContent, 'application/octet-stream')
      ->post('https://api.rembg.com/v1/remove');

    if ($response->successful()) {
        return response($response->body(), 200)->header('Content-Type', 'image/png');
    }

    return response()->json(['error' => 'Background removal failed'], 500);
}
}
