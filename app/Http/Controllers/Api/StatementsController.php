<?php

namespace SisFin\Http\Controllers\Api;

use SisFin\Http\Controllers\Controller;
use SisFin\Http\Controllers\Response;
use SisFin\Http\Requests;
use SisFin\Repositories\StatementRepository;


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

}
