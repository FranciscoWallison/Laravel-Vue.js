<?php

namespace CodeFin\Repositories;

use Carbon\Carbon;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BillReceiveRepository
 * @package namespace CodeFin\Repositories;
 */
interface BillReceiveRepository extends RepositoryInterface, RepositoryCriteriaInterface
{
    // public function getTotalFromPeriod(Carbon $dateStart, Carbon $dateEnd);
}
