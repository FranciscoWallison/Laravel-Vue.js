<?php

namespace SisFin\Mail;

use SisFin\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FirstSubscriptionPaid extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Subscription
     * deixando como publico vai ser passado para view
     */
    public $subscription;
    public $user;

    /**
     * Create a new message instance.
     *
     * @param Subscription $subscription
     */
    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
        $this->user = $subscription->user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Sua assinatura está ativa')
            ->view('emails.subscription_paid');
    }
}
