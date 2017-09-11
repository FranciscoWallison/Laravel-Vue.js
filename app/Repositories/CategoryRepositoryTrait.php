<?php

namespace CodeFin\Repositories;

/**
 * trait CategoryRepositoryTrait
 * @package namespace CodeFin\Repositories;
 */
trait CategoryRepositoryTrait
{

    public function create(array $attributes)
    {
        $model = $this->model();
        $model::$enableTenant = false;
        // verificar se tem valor valido para parent_id
        if(isset($attributes['parent_id']))
        {
            //filha
            $skipPresenter = $this->skipPresenter;
            $this->skipPresenter(true);//escapando presenter estruct->toArray()

            $parent = $this->find($attributes['parent_id']);//pegando a instacia do eloquent

            $this->skipPresenter = $skipPresenter; // retornado ao estado inicial

            

            $child = $parent->children()->create($attributes);

            $result = $this->parserResult($child);

        }else{
            //pai
            $result = parent::create($attributes);
        }
        $model::$enableTenant = true;

        return $result;

    }

    public function update(array $attributes, $id)
    {
        $model = $this->model();
        $model::$enableTenant = false;

        if(isset($attributes['parent_id']))
        {
            //filha
            $skipPresenter = $this->skipPresenter;
            $this->skipPresenter(true);//escapando presenter estruct->toArray()

            $child = $this->find($id);//pegando a instacia do eloquent
            $child->parent_id = $attributes['parent_id'];
            $child->fill($attributes);
            $child->save();

            $this->skipPresenter = $skipPresenter; // retornado ao estado inicial

             $result = $this->parserResult($child);

        }else{
            //pai
            $result = parent::update($attributes, $id);
            $result->makeRoot()->save();
        }
        $model::$enableTenant = true;

        return $result;
    }
}
