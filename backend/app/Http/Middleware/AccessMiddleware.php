<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AccessToken;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('x-api-key');
        $origin = $request->header('Origin');

        if(!$apiKey || !$origin) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $accessToken = AccessToken::find(1);

        if (!$accessToken) {
            return response()->json(['error' => 'Server Error: Access token not found'], 500);
        }

        if($apiKey != $accessToken->token || $origin != $accessToken->origin) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }

        return $next($request);
    }
}
