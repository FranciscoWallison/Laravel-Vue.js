<?php

namespace SisFin\Iugu;

use SisFin\Iugu\Exceptions\IuguInvoiceException;

class IuguInvoiceClient
{
    public function find($id)
    {
    	//
        $result = \Iugu_Invoice::fetch($id);
        if (isset($result['errors'])) {
            throw new IuguInvoiceException($result['errors']);
        }
        return $result;
    }
}