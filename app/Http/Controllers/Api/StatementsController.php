<?php

namespace CodeFin\Http\Controllers\Api;

use Illuminate\Http\Request;
use CodeFin\Http\Controllers\Controller;
use CodeFin\Http\Controllers\Response;
use CodeFin\Http\Requests;
use CodeFin\Repositories\StatementRepository;
use CodeFin\Criteria\FindBetweenDateBRCriteria;

class StatementsController extends Controller
{

    /**
     * @var StatementRepository
     */
    protected $repository;


    public function __construct(StatementRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchParam = config('repository.criterua.params.search');
        $search = $request->get($searchParam);

        $this->repository
            ->pushCriteria(new FindBetweenDateBRCriteria($search, 'created_at'));
        $statements = $this->repository->paginate();

        return $statements;
    }

}
