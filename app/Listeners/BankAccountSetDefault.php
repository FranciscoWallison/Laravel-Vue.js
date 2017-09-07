<?php

namespace CodeFin\Listeners;

use Prettus\Repository\Events\RepositoryEventBase;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BankAccountSetDefault
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RepositoryEventBase  $event
     * @return void
     */
    public function handle(RepositoryEventBase $event)
    {
        //
    }
}
