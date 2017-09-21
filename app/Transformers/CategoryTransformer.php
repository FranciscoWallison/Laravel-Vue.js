<?php

namespace SisFin\Transformers;

use League\Fractal\TransformerAbstract;
use SisFin\Models\AbstractCategory;

/**
 * Class CategoryTransformer
 * @package namespace SisFin\Transformers;
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
    }
}
