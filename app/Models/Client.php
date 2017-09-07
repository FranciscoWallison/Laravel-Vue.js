<?php

namespace CodeFin\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use CodeFin\Models\User;

class Client extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
    	'name'
    ];

    public function users()
    {
    	return $this->hasMany(User::class)
    }

}
