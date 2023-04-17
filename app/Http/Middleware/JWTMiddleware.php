<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $authorization = $request->header('Authorization');

            if(!$authorization) {
                return response()->json([
                    'message' => 'Token must provided'
                ], 401);
            }

            $user = JWT::decode($authorization, env('APP_KEY'), ['HS256']);
            $request['user'] = (array) $user;
            return $next($request);
        } catch(\Exception $err) {
            return response()->json([
                'message' => 'Invalid token or token expired'
            ], 401);
        }

    }
}
