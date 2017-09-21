<?php

namespace SisFin\Http\Controllers\Api;

use SisFin\Criteria\WithDepthCategoriesCriteria;
use Illuminate\Http\Request;
use SisFin\Http\Controllers\Controller;
use SisFin\Repositories\CategoryRevenueRepository;

class CategoryRevenuesController extends Controller
{
    //
    use CategoriesControllerTrait;

    /*
	* @var CategoryRevenueRepository
    */
    protected $repository;

    public function __construct(CategoryRevenueRepository $repository)
    {
    	$this->repository = $repository;
    	$this->repository->pushCriteria(new WithDepthCategoriesCriteria());
    }
}
