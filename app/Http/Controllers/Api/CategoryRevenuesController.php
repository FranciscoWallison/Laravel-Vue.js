<?php

namespace CodeFin\Http\Controllers\Api;

use CodeFin\Criteria\WithDepthCategoriesCriteria;
use Illuminate\Http\Request;
use CodeFin\Http\Controllers\Controller;
use CodeFin\Repositories\CategoryRevenueRepository;

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
