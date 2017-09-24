<?php

namespace SisFin\Iugu;

use Carbon\Carbon;
use SisFin\Iugu\Exceptions\IuguPaymentMethodException;

class IuguPaymentMethodClient
{
    /*
    *   Criando a forma de pagamento 
    */
    public function create(array $attributes)
    {
        $attributes['set_as_default'] = true; //
        $attributes['description'] = "Inserido em " . (new Carbon())->format('d/m/Y');
        $result = \Iugu_PaymentMethod::create($attributes);//cadastrando
        if (isset($result['errors'])) {
            throw new IuguPaymentMethodException($result['errors']);
        }
        return $result;
    }
}