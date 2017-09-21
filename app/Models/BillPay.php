<?php

namespace SisFin\Models;

class BillPay extends AbstractBill
{
    public function category()
    {
        return $this->belongsTo(CategoryExpense::class);
    }
}
