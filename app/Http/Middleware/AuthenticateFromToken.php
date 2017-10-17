<?php

namespace SisFin\Http\Middleware;

use Closure;

class AuthenticateFromToken
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
            if(!\Auth::guard('web')->check() && \Auth::guard('api')->check()){
                $id = \Auth::guard('api')->user()->id;
                \Auth::guard('web')->loginUsingId($id);
            }
            if(!\Auth::guard('web')->check()){
                throw new AuthenticationException('Unauthenticated.');
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(array('message'=>'token_expired'), $e->getStatusCode());
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(array('message'=>'token_invalid'), $e->getStatusCode());
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(array('message'=>'token_absent'), $e->getStatusCode());
        }

        return $next($request);
    }
}
