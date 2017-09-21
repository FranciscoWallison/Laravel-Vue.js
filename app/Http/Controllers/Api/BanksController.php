<?php

namespace SisFin\Http\Controllers\Api;

use Illuminate\Http\Request;
use SisFin\Http\Controllers\Controller;
use SisFin\Repositories\BankRepository;
use SisFin\Http\Requests;

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
