<?php

namespace SisFin\Http\Controllers\Api;

use Carbon\Carbon;
use SisFin\Http\Controllers\Controller;
use SisFin\Http\Controllers\Response;
use SisFin\Http\Requests;
use SisFin\Repositories\StatementRepository;


class CashFlowsController extends Controller
{

    /**
     * @var StatementRepository
     */
    protected $repository;


    public function __construct(StatementRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $dateStart = new Carbon('2018-02-01');
        $dateEnd = $dateStart->copy()->addMonths(10);
        return $this->repository->getCashFlow($dateStart, $dateEnd);
    }

    public function monthly()
    {
        $dateStart = new Carbon();
        $dateEnd = $dateStart->copy()->addDays(30);
        return $this->repository->getCashFlowByPeriod($dateStart,$dateEnd);
    }
}
