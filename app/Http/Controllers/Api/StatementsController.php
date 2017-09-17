<?php

namespace CodeFin\Http\Controllers\Api;

use CodeFin\Http\Controllers\Controller;
use CodeFin\Http\Controllers\Response;
use CodeFin\Http\Requests;
use CodeFin\Repositories\StatementRepository;
use Carbon\Carbon;


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
    public function index()
    {
        return $this->repository->paginate();
    }

    public function listCashFlow(){
        $dateStart  = new Carbon('2017-09-01');
        $dateEnd    = $dateStart->copy()->addMonths(20);
        return $this->repository->getCashFlow($dateStart, $dateEnd);
    }

}
