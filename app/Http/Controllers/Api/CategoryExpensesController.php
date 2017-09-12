<?php

namespace CodeFin\Http\Controllers\Api;

use CodeFin\Criteria\WithDepthCategoriesCriteria;
use Illuminate\Http\Request;
use CodeFin\Http\Controllers\Controller;
use CodeFin\Repositories\CategoryExpenseRepository;

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
