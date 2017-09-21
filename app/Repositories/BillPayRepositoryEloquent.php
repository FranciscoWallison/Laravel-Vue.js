<?php

namespace SisFin\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use SisFin\Repositories\BillPayRepository;
use SisFin\Models\BillPay;
use SisFin\Validators\BillPayValidator;
use SisFin\Presenters\BillPresenter;
use SisFin\Repositories\Traits\BillRepositoryTrait;
use SisFin\Events\BillStoredEvent;


/**
 * Class BillPayRepositoryEloquent
 * @package namespace SisFin\Repositories;
 */
class BillPayRepositoryEloquent extends BaseRepository implements BillPayRepository
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
        return BillPresenter::class;
    }
}
