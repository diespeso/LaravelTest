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
            //$user = JWTAuth::setRequest($request)->parseToken($method = 'bearer', $header = 'authorization')->authenticate();
            $user = JwtAuth::setRequest($request)->parseToken()->authenticate();
            $request->merge(['user' => $user]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'bad token',
            ], 403);
        }
        error_log('testing here');
        return $next($request);
    }
}
