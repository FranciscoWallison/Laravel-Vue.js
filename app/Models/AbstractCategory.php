<?php

namespace CodeFin\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class AbstractCategory extends Model implements Transformable
{
    use TransformableTrait;
    //threads
    use BelongsToTenants; 
    use NodeTrait;



    protected $fillable = ['name'];
    public static $enableTenant = true;

     public function newQuery()
    {
        $builder = $this->newQueryWithoutScopes(); // cria um novo query bulider sem escopo sem interferencia externa (traits)

        foreach ($this->getGlobalScopes() as $identifier => $scope) {  // pega os escopos globais do modelo para aplicar no query builder
            if((static::$enableTenant && $identifier == 'client_id') || $identifier != 'client_id'){  // client_id foi definido no nosso multitanacy
                $builder->withGlobalScope($identifier, $scope);
            }
        }

        return $builder;
    }
    
}
