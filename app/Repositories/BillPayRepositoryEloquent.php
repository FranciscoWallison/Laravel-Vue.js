<?php

namespace CodeFin\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFin\Repositories\BillPayRepository;
use CodeFin\Models\BillPay;
use CodeFin\Validators\BillPayValidator;
use CodeFin\Presenters\BillPayPresenter;


/**
 * Class BillPayRepositoryEloquent
 * @package namespace CodeFin\Repositories;
 */
class BillPayRepositoryEloquent extends BaseRepository implements BillPayRepository
{
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
        return BillPay::class;
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
        return BillPayPresenter::class;
    }
}
