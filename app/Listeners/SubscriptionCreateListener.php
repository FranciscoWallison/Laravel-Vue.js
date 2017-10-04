<?php

namespace SisFin\Listeners;

use SisFin\Events\IuguSubscriptionCreatedEvent;
use SisFin\Models\Subscription;
use SisFin\Repositories\SubscriptionRepository;

class SubscriptionCreateListener
{
    /**
     * @var SubscriptionRepository
     */
    private $repository;

    /**
     * Create the event listener.
     *
     * @param SubscriptionRepository $repository
     */
    public function __construct(SubscriptionRepository $repository)
    {
        $this->repository = $repository;
        $this->repository->skipPresenter(true);
    }

    /**
     * Handle the event.
     *
     * @param  IuguSubscriptionCreatedEvent $event
     * @return void
     */
    public function handle(IuguSubscriptionCreatedEvent $event)
    {
        /*
        * Verificar se esta paga ou pendente
        */
        $iuguSubscription = $event->getIuguSubscription();
        $invoice = $iuguSubscription->recent_invoices[0]; 

        $this->repository->create([
            'expires_at' => $iuguSubscription->expires_at,
            'code' => $iuguSubscription->id,
            'user_id' => $event->getUserId(),
            'plan_id' => $event->getPlanId(),
            //fatura pendente ou paga  'pending' ou 'paid' = pago
            'status'  => $invoice->status == 'paid' ? Subscription::STATUS_ATIVE : Subscription::STATUS_INATIVE
        ]);
    }
}
