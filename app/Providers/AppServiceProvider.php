<?php

namespace SisFin\Providers;

use Illuminate\Support\ServiceProvider;
use SisFin\Jwt\Manager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //capturando sql
        // \DB::listen(function ($query){
        //     //dd($query->sql);
        //     echo $query->sql;
        // });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('tymon.jwt.manager', function ($app) {
            $instance = new Manager(
                $app['tymon.jwt.provider.jwt'],
                $app['tymon.jwt.blacklist'],
                $app['tymon.jwt.payload.factory']
            );

            return $instance->setBlacklistEnabled((bool) config('jwt.blacklist_enabled'))
                            ->setPersistentClaims(config('jwt.persistent_claims'));
        });
        \Iugu::setApiKey(env('IUGU_API_KEY'));//psr-0 integrando com a iugu
    }
}
