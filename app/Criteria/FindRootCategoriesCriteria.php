<?php

namespace SisFin\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindRootCategoriesCriteria
 * @package namespace SisFin\Criteria;
 */
class FindRootCategoriesCriteria implements CriteriaInterface
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
        return $model->whereIsRoot();// where parent_id = null procurar pelo pai
    }
}
