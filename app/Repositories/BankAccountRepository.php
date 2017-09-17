<?php

namespace CodeFin\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;

/**
 * Interface BankAccountRepository
 * @package namespace CodeFin\Repositories;
 */
interface BankAccountRepository extends RepositoryInterface, RepositoryCriteriaInterface
{
    public function addBalance($id, $value);
}
