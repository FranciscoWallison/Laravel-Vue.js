<?php

namespace SisFin\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SisFin\Repositories\CategoryRevenueRepository;
use SisFin\Models\CategoryRevenue;
use SisFin\Validators\CategoryRevenueValidator;
use SisFin\Presenters\CategoryPresenter;

/**
 * Class CategoryRevenueRepositoryEloquent
 * @package namespace SisFin\Repositories;
 */
class CategoryRevenueRepositoryEloquent extends BaseRepository implements CategoryRevenueRepository
{
    use CategoryRepositoryTrait;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CategoryRevenue::class;
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
