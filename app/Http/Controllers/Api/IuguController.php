<?php

namespace SisFin\Http\Controllers\Api;

use SisFin\Http\Controllers\Controller;
use SisFin\Iugu\IuguSubscriptionManager;
use SisFin\Iugu\OrderManager;
use SisFin\Iugu\SubscriptionManager;
use SisFin\Mail\FirstSubscriptionPaid;
use SisFin\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class IuguController extends Controller
{
    /**
     * @var OrderManager
     */
    private $orderManager;
    /**
     * @var IuguSubscriptionManager
     */
    private $subscriptionManager;

    /**
     * IuguController constructor.
     * @param OrderManager $orderManager
     * @param IuguSubscriptionManager $subscriptionManager
     */
    public function __construct(OrderManager $orderManager, SubscriptionManager $subscriptionManager)
    {
        $this->orderManager = $orderManager;
        $this->subscriptionManager = $subscriptionManager;
    }

    public function hooks(Request $request)//para capturar os gatilho da iugu
    {
        $event = $request->get('event');
        $data = $request->get("data", []);//[] colocar um array vazio para caso alquem tenha pego a URL

        switch ($event) {
            case 'invoice.created':
                $this->orderManager->create($data);
                break;
            case 'invoice.status_changed': //status pago
                if ($data['status'] == 'paid') {
                    $this->orderManager->paid($data);
                }
                break;
            case 'subscription.renewed': //status de assinatura renovada
                $subscription = $this->subscriptionManager->renew($data);
                if ($subscription && $subscription->orders()->where('status', Order::STATUS_PAID)->count() == 1) {
                    Mail::to($subscription->user)->send(new FirstSubscriptionPaid($subscription)); //foi feito o pagamento
                }
                break;
        }
    }
}
