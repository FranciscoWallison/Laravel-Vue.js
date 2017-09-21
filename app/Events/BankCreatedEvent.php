<?php

namespace SisFin\Events;

use SisFin\Models\Bank;

class BankCreatedEvent
{
    //use InteractsWithSockets, SerializesModels;

    private $bank;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Bank $bank)
    {
        //
        $this->bank = $bank;
    }

    public function getBank()
    {
       return $this->bank;
    }
}
