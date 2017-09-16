<?php

namespace CodeFin\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use HipsterJazzbo\Landlord\BelongsToTenants;

class BillPay extends Model implements Transformable, BillRepeatTypeInterface
{
    use TransformableTrait;
    use BelongsToTenants;
    use BillTrait;

    protected $fillable = [
    	'date_due',
    	'name',
    	'value',
    	'done',
    	'bank_account_id',
    	'category_id'
    ];

}
