<?php

namespace SisFin\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;

/**
 * Interface BankAccountRepository
 * @package namespace SisFin\Repositories;
 */
interface BankAccountRepository extends RepositoryInterface, RepositoryCriteriaInterface
{
    public function addBalance($id, $value);
}
