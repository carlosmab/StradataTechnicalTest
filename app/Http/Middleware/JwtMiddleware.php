<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 'Token is Invalid'])
                            ->setStatusCode(Response::HTTP_FORBIDDEN);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status' => 'Token is Expired'])
                            ->setStatusCode(Response::HTTP_FORBIDDEN);
            }else{
                return response()->json(['status' => 'Authorization Token not found'])
                            ->setStatusCode(Response::HTTP_FORBIDDEN);
            }
        }
        return $next($request);
    }
}
