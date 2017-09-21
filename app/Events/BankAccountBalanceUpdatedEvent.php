<?php

namespace SisFin\Events;

use SisFin\Models\BankAccount;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BankAccountBalanceUpdatedEvent implements ShouldBroadcast
{
    /**
     * @var BankAccount
     * tem q ser public
     */
    public $bankAccount;

    public function __construct(BankAccount $bankAccount)
    {
        $this->bankAccount = $bankAccount;
    }
    /*
    * calnal para ver os client
    */
    public function broadcastOn()
    {
        return new PrivateChannel("client.{$this->bankAccount->client_id}");
    }
}
