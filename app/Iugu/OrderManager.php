<?php
/*
* Criando gatinho
* Administração > gatilho
*/

namespace SisFin\Iugu;


use Carbon\Carbon;
use SisFin\Models\Order;
use SisFin\Repositories\Interfaces\OrderRepository;
use SisFin\Repositories\Interfaces\SubscriptionRepository;

class OrderManager
{
    /**
     * @var IuguSubscriptionClient
     */
    private $iuguSubscriptionClient;
    /**
     * @var SubscriptionRepository
     */
    private $subscriptionRepository;
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var IuguInvoiceClient
     */
    private $iuguInvoiceClient;

    /**
     * OrderManager constructor.
     * @param IuguSubscriptionClient $iuguSubscriptionClient
     * @param SubscriptionRepository $subscriptionRepository
     * @param OrderRepository $orderRepository
     */
    public function __construct(IuguSubscriptionClient $iuguSubscriptionClient,
                                IuguInvoiceClient $iuguInvoiceClient,
                                SubscriptionRepository $subscriptionRepository,
                                OrderRepository $orderRepository)
    {
        $this->iuguSubscriptionClient = $iuguSubscriptionClient;
        $this->subscriptionRepository = $subscriptionRepository;
        $this->orderRepository = $orderRepository;
        $this->iuguInvoiceClient = $iuguInvoiceClient;
    }

    public function create(array $data)
    {
        $iuguSubscription = $this->iuguSubscriptionClient->find($data['subscription_id']);
        $subscription = $this->subscriptionRepository->findByField('code', $iuguSubscription->id)->first();
        if ($subscription) {
            $invoice = $iuguSubscription->recent_invoices[0];//pegar a ultima order
            $total = $this->getTotal($invoice->total);//pegar o valor q foi pago

            return $this->orderRepository->create([
                'date_due' => $invoice->due_date,
                'code' => $invoice->id,
                'subscription_id' => $subscription->id,
                'value' => $total,
                'status' => $invoice->status == 'paid' ? Order::STATUS_PAID : Order::STATUS_PENDING,
                'payment_date' => $invoice->status == 'paid' ? (new Carbon())->format('Y-m-d') : null,
                'payment_url' => $invoice->secure_url
            ]);
        }
    }

    /*
    * 
    */
    public function paid(array $data)
    {
        $invoice = $this->iuguInvoiceClient->find($data['id']);
        //pegando o primeiro resultado
        $order = $this->orderRepository->findByField('code',$invoice->id)->first();
        //verificar se esta pagou ou pendente
        if($order && $order->status != Order::STATUS_PAID){
            $this->orderRepository->update([
                'status' => Order::STATUS_PAID,
                'payment_date' => (new Carbon())->format('Y-m-d')//gerando a data de pagamento
            ], $order->id);
        }
    }

    protected function getTotal($value)
    {
        $value = str_replace(' ', '', $value);
        $curr = "R$";
        $numberFormat = new \NumberFormatter('pt-BR', \NumberFormatter::CURRENCY);
        return $numberFormat->parseCurrency($value, $curr);
    }
}