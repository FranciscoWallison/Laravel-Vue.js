<?php

namespace CodeFin\Transformers;

use League\Fractal\TransformerAbstract;
use CodeFin\Models\AbstractCategory;

/**
 * Class CategoryTransformer
 * @package namespace CodeFin\Transformers;
 */
class CategoryTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['children']; 

    /**
     * Transform the \AbstractCategory entity
     * @param \AbstractCategory $model
     *
     * @return array
     */
    public function transform(AbstractCategory $model)
    {
        return [
            'id'         => (int) $model->id,
            'name'       => $model->name,          
            'parent_id'  => $model->parent_id,
            'depth'      => $model->depth, // nivel da subcategoria

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeChildren(AbstractCategory $model)
    {
        
        $children = $model->children()->withDepth()->get();
        return $this->collection($children, new CategoryTransformer());
        // //children tirando os children vazios
        // if($model->children->count()){
        //      return $this->collection($model->children, new CategoryTransformer());//verifica se tem filho
        // }
        // //nem toda categoria vai ter filho
        // if($model->children)
        // {
        //     return $this->collection($model->children, new CategoryTransformer());//verifica se tem filho
        // }
    }
}
