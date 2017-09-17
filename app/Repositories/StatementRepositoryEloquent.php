<?php

namespace CodeFin\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFin\Repositories\StatementRepository;
use CodeFin\Models\Statement;

use CodeFin\Models\CategoryRevenue;
use CodeFin\Models\BillReceive;

use CodeFin\Models\CategoryExpense;
use CodeFin\Models\BillPay;

use Illuminate\Database\MySqlConnection;
use Illuminate\Database\PostgresConnection;

use CodeFin\Repositories\Traits\CashFlowRepositoryTrait;


/**
 * Class StatementRepositoryEloquent
 * @package namespace CodeFin\Repositories;
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
            ->groupBy('id')
            ->get();
        $result = $collection->first();
        return [
            'count' => (float)$result->count,
            'total' => (float)$result->total
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
}
