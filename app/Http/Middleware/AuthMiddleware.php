<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token inválido o ausente'], 401);
        }

        return $next($request);
    }
}
