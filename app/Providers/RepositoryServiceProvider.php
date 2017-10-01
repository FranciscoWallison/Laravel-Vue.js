<?php

namespace SisFin\Providers;

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
        $this->app->bind(\SisFin\Repositories\BankRepository::class, \SisFin\Repositories\BankRepositoryEloquent::class);
        $this->app->bind(\SisFin\Repositories\BankAccountRepository::class, \SisFin\Repositories\BankAccountRepositoryEloquent::class);
        $this->app->bind(\SisFin\Repositories\ClientRepository::class, \SisFin\Repositories\ClientRepositoryEloquent::class);
        $this->app->bind(\SisFin\Repositories\CategoryExpenseRepository::class, \SisFin\Repositories\CategoryExpenseRepositoryEloquent::class);
        $this->app->bind(\SisFin\Repositories\CategoryRevenueRepository::class, \SisFin\Repositories\CategoryRevenueRepositoryEloquent::class);
        $this->app->bind(\SisFin\Repositories\BillPayRepository::class, \SisFin\Repositories\BillPayRepositoryEloquent::class);
        $this->app->bind(\SisFin\Repositories\BillReceiveRepository::class, \SisFin\Repositories\BillReceiveRepositoryEloquent::class);
        $this->app->bind(\SisFin\Repositories\StatementRepository::class, \SisFin\Repositories\StatementRepositoryEloquent::class);

        $this->app->bind(\SisFin\Repositories\PlanRepository::class, \SisFin\Repositories\PlanRepositoryEloquent::class);
        $this->app->bind(\SisFin\Repositories\UserRepository::class, \SisFin\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\SisFin\Repositories\SubscriptionRepository::class, \SisFin\Repositories\SubscriptionRepositoryEloquent::class);
        //:end-bindings:
    }
}
