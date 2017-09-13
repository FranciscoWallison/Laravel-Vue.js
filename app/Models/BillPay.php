<?php

namespace CodeFin\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use HipsterJazzbo\Landlord\BelongsToTenants;

class BillPay extends Model implements Transformable
{
    use TransformableTrait;
    use BelongsToTenants;

    protected $fillable = [
    	'date_due',
    	'name',
    	'value',
    	'done'
    ];

}
