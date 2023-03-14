<?php

namespace App\Http\Middleware;
use Exception;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //validaciones en caso de que el usuario este autenticado 
        try {

            JWTAuth::parseToken()->authenticate();

        } catch (Exception $e) {
            if($e instanceof TokenInvalidException)
            {
                return response()->json(["error"=>"Token Invalido"],401);
            }

            if($e instanceof TokenExpiredException)
            {
                return response()->json(["error"=>"Token Expirado"],401);
            }

            return response()->json(["error"=>"Token token no encontrado"],401);

        }
        return $next($request);
    }
}
