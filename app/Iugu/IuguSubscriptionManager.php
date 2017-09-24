<?php
/*
* Gerencia as assinaturas com os planos 
*
*/

namespace SisFin\Iugu;


use SisFin\Models\Client;
use SisFin\Models\Plan;
use SisFin\Models\User;

class IuguSubscriptionManager
{
    /**
     * @var IuguCustomerClient
     */
    private $iuguCustomerClient;
    /**
     * @var IuguPaymentMethodClient
     */
    private $iuguPaymentMethodClient;
    /**
     * @var IuguSubscriptionClient
     */
    private $iuguSubscriptionClient;

    /**
     * IugiSubscriptionManager constructor.
     * @param IuguCustomerClient $iuguCustomerClient
     * @param IuguPaymentMethodClient $iuguPaymentMethodClient
     * @param IuguSubscriptionClient $iuguSubscriptionClient
     */
    public function __construct(IuguCustomerClient $iuguCustomerClient,
                                IuguPaymentMethodClient $iuguPaymentMethodClient,
                                IuguSubscriptionClient $iuguSubscriptionClient)
    {
        $this->iuguCustomerClient = $iuguCustomerClient;
        $this->iuguPaymentMethodClient = $iuguPaymentMethodClient;
        $this->iuguSubscriptionClient = $iuguSubscriptionClient;
    }

    /**
     * @param User $user
     * @param Plan $plan
     * @param array $data
     */
    public function create(User $user, Plan $plan, array $data)
    {
        $client = $user->client;
        $customer = $this->makeCustomer($client);// quarda o codigo do client
        $customerId = $customer == null ? $client->code : $customer['id']; // se tem cadastro na iugu
        $this->makePaymentMethod($customerId, $data['payment_type'], $data['token_payment']);//
        //criando a assinatura na iugu
        return $this->iuguSubscriptionClient->create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'plan_identifier' => $plan->code,
            'customer_id' => $customerId,
            'payment_type' => $data['payment_type']
        ]);
    }

    /*
    * cria o cliente na iugu
    */
    protected function makeCustomer(Client $client)
    {
        if($client->code == null){// verificar se tem cadastro na iugu
            return $this->iuguCustomerClient->create($client->toArray());
        }
        return null;
    }

    /*
    * Gerar cadastro da forma de pagamento 
    */
    protected function makePaymentMethod($customerId, $paymentType, $tokenPayment)
    {
        if($paymentType == 'credit_card'){
            return $this->iuguPaymentMethodClient->create([
                'customer_id' => $customerId,
                'token' => $tokenPayment
            ]);
        }
    }
}