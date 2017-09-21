<?php

namespace SisFin\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class LockTableCriteria
 * @package namespace SisFin\Criteria;
 */
class LockTableCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        /*
        * Vai fazer um bloqueio na tabela para 
        **/
        return $model->lockForUpdate();
    }
}
