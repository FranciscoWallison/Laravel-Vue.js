<?php

namespace SisFin\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Prettus\Repository\Events\RepositoryEntityCreated;
use Prettus\Repository\Events\RepositoryEntityUpdated;

use SisFin\Listeners\BankAccountSetDefaultListener;
use SisFin\Events\BankStoredEvent;
use SisFin\Listeners\BankLogoUploadListener;
use SisFin\Events\BillStoredEvent;
use SisFin\Listeners\BankAccountUpdateBalanceListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        BankStoredEvent::class => [
            BankLogoUploadListener::class,
        ],
        RepositoryEntityCreated::class => [
            BankAccountSetDefaultListener::class
        ],
        BillStoredEvent::class => [
            BankAccountUpdateBalanceListener::class
        ],
        RepositoryEntityUpdated::class => [
            BankAccountSetDefaultListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
