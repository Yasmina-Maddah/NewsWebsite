<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminJWTMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        return response()->json(['message' => 'Forbidden'], 403);
    }
}