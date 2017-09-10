<?php

namespace CodeFin\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFin\Repositories\CategoryRepository;
use CodeFin\Models\Category;
use CodeFin\Validators\CategoryValidator;
use CodeFin\Presenters\CategoryPresenter;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace CodeFin\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{

    public function create(array $attributes)
    {
        Category::$enableTenant = false;
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
        Category::$enableTenant = true;

        return $result;

    }

    public function update(array $attributes, $id)
    {
        Category::$enableTenant = false;

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
        Category::$enableTenant = true;

        return $result;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return CategoryPresenter::class;
    }
}
