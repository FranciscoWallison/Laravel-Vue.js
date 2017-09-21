<?php

namespace SisFin\Http\Middleware;

use Closure;

class AddCliebtTenantMiddleware
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
        if($request->is('api/*'))
        {
            $user = \Auth::guard('api')->user();
            if($user){ // verifica se ta logado
                $client = $user->client;//chamando o modelo
                \Landlord::addTenant($client); // observador 
            }
        }
        return $next($request);
    }
}
