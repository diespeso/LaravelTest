<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware {
    public function handle($request, Closure $next) {
        error_log('testing here middleware auth');
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            return response()->json([
                'error' => 'bad token',
            ]);
        }
        error_log('testing here');
        return $next($request);
    }
}
