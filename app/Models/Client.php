<?php

namespace SisFin\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use SisFin\Models\User;
use SisFin\Models\BankAccount;
use SisFin\Models\CategoryExpense;
use SisFin\Models\CategoryRevenue;

class Client extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
    	'name',
        'email',
        'code'
    ];

    public function users()
    {
    	return $this->hasMany(User::class);
    }

    public function bankAccounts()
    {
    	return $this->hasMany(BankAccount::class);
    }

    public function categoryExpenses()
    {
    	return $this->hasMany(CategoryExpense::class);
    }

    public function categoryRevenues()
    {
        return $this->hasMany(CategoryRevenue::class);
    }

}
