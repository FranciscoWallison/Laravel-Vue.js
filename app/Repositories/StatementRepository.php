<?php

namespace SisFin\Repositories;

use Carbon\Carbon;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface StatementRepository
 * @package namespace SisFin\Repositories;
 */
interface StatementRepository extends RepositoryInterface
{
    public function getCashFlow(Carbon $dateStart, Carbon $dateEnd);
    public function getBalanceByMonth(Carbon $date);
    public function getCashFlowByPeriod(Carbon $dateStart, Carbon $dateEnd);
}
