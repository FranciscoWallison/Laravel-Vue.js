<?php

namespace SisFin\Iugu;


use SisFin\Events\IuguSubscriptionCreatedEvent;
use SisFin\Iugu\Exceptions\IuguSubscriptionException;

class IuguSubscriptionClient
{
    public function find($id){
        //trabalhando com gatinho
        $result = \Iugu_Subscription::fetch($id);
        if(isset($result['errors'])){
            throw new IuguSubscriptionException($result['errors']);
        }
        return $result;
    }

    public function create(array $attributes)
    {
        $paymentType = $attributes['payment_type'];
        $attributes['payable_with'] = $paymentType;//tipo de pagamanto
        //caso seja cartão de credito
        $attributes['only_on_charge_success'] = $paymentType == 'credit_card' ? true : false;
        //
        $result = \Iugu_Subscription::create(array_only($attributes, [
            'customer_id',
            'payable_with',
            'only_on_charge_success',
            'plan_identifier'
        ]));
//dd($result); #_attributes: array 28 ~ VERIFICAR SE ESTA EM MODO TEST
        if(isset($result['errors'])){
            throw new IuguSubscriptionException($result['errors']);
        }
        //quando a assinatura for criada
        event(new IuguSubscriptionCreatedEvent(
                $result,$attributes['user_id'],$attributes['plan_id']
            ));
        return $result;
    }

    public function suspend($id)
    {
        $result = \Iugu_Subscription::fetch($id);
        if(isset($result['errors'])){
            throw new IuguSubscriptionException($result['errors']);
        }
        $result = $result->suspend();
        if(isset($result['errors'])){
            throw new IuguSubscriptionException($result['errors']);
        }
    }
}