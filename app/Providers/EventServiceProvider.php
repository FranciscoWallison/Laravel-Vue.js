<?php

namespace CodeFin\Providers;

use CodeFin\Events\BankCreatedEvent;
use CodeFin\Listeners\BankLogoUpaloadListener;
use CodeFin\Listeners\BankActionListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        BankCreatedEvent::class => [
            BankLogoUpaloadListener::class,
            BankActionListener::class
        ]
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
