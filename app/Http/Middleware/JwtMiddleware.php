<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use JWTAuth;
use Illuminate\Http\Request;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json([
                    "code"      =>  \HttpStatus::UNAUTHORIZE,
                    "status"    =>  false,
                    "message"   =>  "Token is Invalid",
                    "data"      =>  null
                    ], \HttpStatus::UNAUTHORIZE);

            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json([
                    "code"      =>  \HttpStatus::UNAUTHORIZE,
                    "status"    =>  false,
                    "message"   =>  "Token is Expired",
                    "data"      =>  null
                    ], \HttpStatus::UNAUTHORIZE);
            }else{
                return response()->json([
                    "code"      =>  \HttpStatus::UNAUTHORIZE,
                    "status"    =>  false,
                    "message"   =>  "Authorization Token not found",
                    "data"      =>  null
                    ], \HttpStatus::UNAUTHORIZE);
            }
        }
        return $next($request);
    }
}
