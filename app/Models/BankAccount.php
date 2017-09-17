<?php

namespace CodeFin\Models;

use HipsterJazzbo\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use CodeFin\Models\Bank;

class BankAccount extends Model implements Transformable
{
    use TransformableTrait;
    use BelongsToTenants; //threads

    protected $fillable = [
    	'name',
    	'agency',
    	'account',
    	'bank_id',
        'default'
    ];

    //definindo tipo
    protected $casts = [
        'balance' => 'float'
    ];

    public function bank()
    {
    	return $this->belongsTo(Bank::class);
    }

}
