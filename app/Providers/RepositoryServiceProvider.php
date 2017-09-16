<?php

namespace CodeFin\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\CodeFin\Repositories\BankRepository::class, \CodeFin\Repositories\BankRepositoryEloquent::class);
        $this->app->bind(\CodeFin\Repositories\BankAccountRepository::class, \CodeFin\Repositories\BankAccountRepositoryEloquent::class);
        $this->app->bind(\CodeFin\Repositories\ClientRepository::class, \CodeFin\Repositories\ClientRepositoryEloquent::class);
        $this->app->bind(\CodeFin\Repositories\CategoryExpenseRepository::class, \CodeFin\Repositories\CategoryExpenseRepositoryEloquent::class);
        $this->app->bind(\CodeFin\Repositories\CategoryRevenueRepository::class, \CodeFin\Repositories\CategoryRevenueRepositoryEloquent::class);
        $this->app->bind(\CodeFin\Repositories\BillPayRepository::class, \CodeFin\Repositories\BillPayRepositoryEloquent::class);
        $this->app->bind(\CodeFin\Repositories\BillReceiveRepository::class, \CodeFin\Repositories\BillReceiveRepositoryEloquent::class);
        $this->app->bind(\CodeFin\Repositories\StatementRepository::class, \CodeFin\Repositories\StatementRepositoryEloquent::class);
        //:end-bindings:
    }
}
