<?php

namespace SisFin\Iugu;


use Carbon\Carbon;
use SisFin\Criteria\FindByUserCriteria;
use SisFin\Models\Subscription;
use SisFin\Repositories\Interfaces\SubscriptionRepository;

class SubscriptionManager
{
    /**
     * @var iuguSubscriptionClient
     */
    private $iuguSubscriptionClient;
    /**
     * @var SubscriptionRepository
     */
    private $subscriptionRepository;

    public function __construct(iuguSubscriptionClient $iuguSubscriptionClient, SubscriptionRepository $subscriptionRepository)
    {
        $this->iuguSubscriptionClient = $iuguSubscriptionClient;
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function renew(array $data)
    {
        $iuguSubscription = $this->iuguSubscriptionClient->find($data['id']);
        $subscription = $this->subscriptionRepository->findByField('code', $iuguSubscription->id)->first();
        $result = $subscription; 

        //verificar se assinatura local é diferente da nova assinatura
        if ($subscription && $subscription->expires_at != $iuguSubscription->expires_at) {
            $result = $this->subscriptionRepository->update([
                'expires_at' => $iuguSubscription->expires_at,
                'status' => Subscription::STATUS_ATIVE
            ], $subscription->id);
        }
        return $result;
    }

    public function cancel($subscriptionId)
    {
        $this->subscriptionRepository->pushCriteria(new FindByUserCriteria());
        $subscription = $this->subscriptionRepository->find($subscriptionId);
        $this->iuguSubscriptionClient->suspend($subscription->code);
        $this->subscriptionRepository->update([
            'status' => Subscription::STATUS_INATIVE,
            'canceled_at' => (new Carbon())->format('Y-m-d')
        ],$subscription->id);
    }
}