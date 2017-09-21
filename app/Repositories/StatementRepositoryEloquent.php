<?php

namespace SisFin\Repositories;

use SisFin\Presenters\StatementSerializerPresenter;
use SisFin\Models\BillPay;
use SisFin\Models\BillReceive;
use SisFin\Models\Statement;
use SisFin\Repositories\StatementRepository;
use SisFin\Repositories\Traits\CashFlowRepositoryTrait;
use SisFin\Serializer\StatementSerializer;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class StatementRepositoryEloquent
 * @package namespace SisFin\Repositories;
 */
class StatementRepositoryEloquent extends BaseRepository implements StatementRepository
{
    use CashFlowRepositoryTrait;

    public function paginate($limit = null, $columns = ['*'], $method = "paginate")
    {
        $skipPresenter = $this->skipPresenter;
        $this->skipPresenter();
        $collection = parent::paginate($limit,$columns,$method);
        $this->skipPresenter($skipPresenter);
        return $this->parserResult(new StatementSerializer($collection,$this->formatStatementsData()));
    }

    protected function getCountAndTotalByBill($billType)
    {
        $this->resetModel();
        $this->applyCriteria();
        $collection = $this->model->selectRaw('COUNT(id) as count, SUM(value) as total')
            ->where('statementable_type','=',$billType)
            ->get();
        $result = $collection->first();
        return $result  ? [
            'count' => (float)$result->count,
            'total' => (float)$result->total
        ] : [
            'count' => 0,
            'total' => 0
        ];
    }

    protected function formatStatementsData()
    {
        $resultRevenue = $this->getCountAndTotalByBill(BillReceive::class);
        $resultExpense = $this->getCountAndTotalByBill(BillPay::class);

        return [
            'count' => $resultRevenue['count'] + $resultExpense['count'],
            'revenues' => ['total' => $resultRevenue['total']],
            'expenses' => ['total' => $resultExpense['total']]
        ];
    }

    public function create(array $attributes)
    {
        $statementable = $attributes['statementable'];
        return $statementable->statements()->create(array_except($attributes, 'statementable'));
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Statement::class;
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
        return StatementSerializerPresenter::class;
    }
}

