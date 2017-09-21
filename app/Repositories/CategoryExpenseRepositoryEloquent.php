<?php

namespace SisFin\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SisFin\Repositories\CategoryExpenseRepository;
use SisFin\Models\CategoryExpense;
use SisFin\Validators\CategoryExpenseValidator;
use SisFin\Presenters\CategoryPresenter;

/**
 * Class CategoryExpenseRepositoryEloquent
 * @package namespace SisFin\Repositories;
 */
class CategoryExpenseRepositoryEloquent extends BaseRepository implements CategoryExpenseRepository
{
    use CategoryRepositoryTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CategoryExpense::class;
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
