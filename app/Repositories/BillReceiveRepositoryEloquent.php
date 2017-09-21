<?php

namespace SisFin\Repositories;

use SisFin\Models\BillReceive;
use SisFin\Presenters\BillPresenter;
use SisFin\Repositories\BillReceiveRepository;
use SisFin\Repositories\Traits\BillRepositoryTrait;
use SisFin\Validators\BillReceiveValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class BillReceiveRepositoryEloquent
 * @package namespace SisFin\Repositories;
 */
class BillReceiveRepositoryEloquent extends BaseRepository implements BillReceiveRepository
{
    use BillRepositoryTrait;

    protected $fieldSearchable = [
        'date_due'  => 'LIKE',
        'name'      => 'LIKE',
        'value'     => 'LIKE',
        'done'      => 'LIKE'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BillReceive::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return BillPresenter::class;
    }
}
