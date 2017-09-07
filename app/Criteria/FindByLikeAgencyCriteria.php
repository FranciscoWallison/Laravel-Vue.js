<?php

namespace CodeFin\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindByLikeAgencyCriteria
 * @package namespace CodeFin\Criteria;
 */
class FindByLikeAgencyCriteria implements CriteriaInterface
{
    private $agency;

    public function __construct($agency)
    {
        $this->agency = $agency;
    }
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
        return $model->where('agency', 'LIKE', "%{$this->agency}%");
    }
}
