<?php

namespace SisFin\Http\Controllers\Api;

use SisFin\Criteria\WithDepthCategoriesCriteria;
use Illuminate\Http\Request;
use SisFin\Http\Controllers\Controller;
use SisFin\Repositories\CategoryExpenseRepository;

class CategoryExpensesController extends Controller
{
    //
    use CategoriesControllerTrait;

    protected $repository;

    public function __construct(CategoryExpenseRepository $repository)
    {

    	$this->repository = $repository;
    	$this->repository->pushCriteria(new WithDepthCategoriesCriteria());
    }
}
