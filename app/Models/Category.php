<?php

namespace CodeFin\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use HipsterJazzbo\Landlord\BelongsToTenants;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model implements Transformable
{
    use TransformableTrait;
    //threads
    use BelongsToTenants; 
    use NodeTrait;

    protected $fillable = ['name'];

}
