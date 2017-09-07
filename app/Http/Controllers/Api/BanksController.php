<?php

namespace CodeFin\Http\Controllers\Api;

use Illuminate\Http\Request;
use CodeFin\Http\Controllers\Controller;
use CodeFin\Repositories\BankRepository;
use CodeFin\Http\Requests;

class BanksController extends Controller
{
    /**
     * @var BankRepository
     */
    private $repository;

    /**
     * BanksController constructor.
     * @param BankRepository $repository
     */
    public function __construct(BankRepository $repository){
        $this->repository = $repository;
    }

    public function index(){
        return $this->repository->all();
    }
}
