<?php

namespace CodeFin\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFin\Repositories\StatementRepository;
use CodeFin\Models\Statement;
use CodeFin\Validators\StatementValidator;
use Carbon\Carbon;

use CodeFin\Models\CategoryRevenue;
use CodeFin\Models\BillReceive;

use CodeFin\Models\CategoryExpense;
use CodeFin\Models\BillPay;


/**
 * Class StatementRepositoryEloquent
 * @package namespace CodeFin\Repositories;
 */
class StatementRepositoryEloquent extends BaseRepository implements StatementRepository
{

    public function create(array $attributes)
    {
        $statementable = $attributes['statementable'];
        return $statementable->statements()->create(array_except($attributes, 'statementable'));
    }

    public function getCashFlow(Carbon $dateStart, Carbon $dateEnd) // coleção de receitas e despesas 
    {
        $datePrevious = $dateStart->copy()->day(1)->subMonths(2);
        $datePrevious->day($datePrevious->daysInMonth);
        $balancePreviousMonth = $this->getBalanceByMonth($datePrevious);

        $revenuesCollection = $this->getCategoriesValuesCollection(
            new CategoryRevenue(),
            (new BillReceive())->getTable(),
            $dateStart,
            $dateEnd
        );

        $expensesCollection = $this->getCategoriesValuesCollection(
            new CategoryExpense(),
            (new BillPay())->getTable(),// despesas com conta apagar
            $dateStart,
            $dateEnd
        );

        return $this->formatCashFlow($expensesCollection, $revenuesCollection, $balancePreviousMonth);//forta
    }

    protected function formatCategories($collection)
    {   
        /*
        * id: 0
        * name: Category X
        * months: [
        * { total: 10, month_year: '2017-02'}, {total: 40, month_year: '2017-04' }
        * ]
        */
        $categories = $collection->unique('name')->pluck('name', 'id')->all();
        $arrayResult = [];

        foreach ($categories as $id => $name) {
            $filtered = $collection->where('id', $id)->where('name', $name);//filtrando as categorias 
            $periods = [];
            $filtered->each(function ($category) use (&$periods) {
                $periods[] = [
                    'total' => $category->total,
                    'period' => $category->period,
                ];
            });
            $arrayResult[] = [
                'id' => $id,
                'name' => $name,
                'periods' => $periods,
            ];
        }
        return $arrayResult;
    }


    protected function formatCashFlow($expensesCollection, $revenuesCollection, $balancePreviousMonth)
    {
        // $periodList = $this->formatPeriods($expensesCollection, $revenuesCollection);
        $expensesFormatted = $this->formatCategories($expensesCollection);
        $revenuesFormatted = $this->formatCategories($revenuesCollection);

        // $collectionFormatted = [
        //     'period_list' => $periodList,
        //     'balance_before_first_month' => $balancePreviousMonth,
        //     'categories_period' => [
        //         'expenses' => [
        //             'data' => $expensesFormatted
        //         ],
        //         'revenues' => [
        //             'data' => $revenuesFormatted
        //         ]
        //     ]
        // ];

        // return $collectionFormatted;
    }

    protected function getCategoriesValuesCollection($model, $billTable, Carbon $dateStart, Carbon $dateEnd)
    {
        $dateStartStr = $dateStart->copy()->day(1)->format('Y-m-d');// dia primeiro do mes 
        $dateEndStr = $dateEnd->copy()->day($dateEnd->daysInMonth)->format('Y-m-d'); // ultimo dia do mes

        $firstDateStart = $dateStart->copy()->subMonths(1);  // primeiro de janeiro
        $firstDateStartStr = $firstDateStart->format('Y-m-d');

        $firstDateEnd = $firstDateStart->copy()->day($firstDateStart->daysInMonth);  // 31 de janeiro
        $firstDateEndStr = $firstDateEnd->format('Y-m-d');

        $firstCollection = $this->getQueryCategoriesValuesByPeriodAndDone( //coleção das contas que foram pagas
            $model,
            $billTable,
            $firstDateEndStr,
            $firstDateEndStr
        )->get();

        $mainCollection = $this->getQueryCategoriesValuesByPeriod(
            $model,
            $billTable,
            $dateStartStr,
            $dateEndStr
        )->get();

        $firstCollection->reverse()->each(function ($value) use ($mainCollection) {
            $mainCollection->prepend($value);
        });

        return $mainCollection;
    }

    protected function getQueryCategoriesValuesByPeriodAndDone($model, $billTable, $dateStart, $dateEnd)
    {
        return $this->getQueryCategoriesValuesByPeriod($model, $billTable, $dateStart, $dateEnd)
            ->whereRaw("done = true");
    }

    /*
     * Qual é o id e o ultimo extrato
     * Jan Fev Mar Abr Mai
     * Saldo Final
     * Geracao caixa
     * Saldo do mês anterior
     * Recebimentos 
     *      Categoria X 20 | 30 | 40
     *           Categoria Filha 1 10 
     *           Categoria Filha 2 10 
     *      Categoria Y 20 | 30 | 40
     *      Categoria Z 20 | 30 | 40
     * Pagamentos 
     *      Categoria X, Y, Z
     */
    
    /*
    * Pegar o saldo do mes
    */
    protected function getQueryCategoriesValuesByPeriod($model, $billTable, $dateStart, $dateEnd, $dateFormat = '%Y-%m')
    {
        $table = $model->getTable();
        list($lft, $rgt) = [$model->getLftName(), $model->getRgtName()];

        // $subQuery = $this->getQueryWithDepth($model);
        return $model
            ->addSelect("$table.id")// select catergory
            ->addSelect("$table.name")// 
            ->selectRaw("SUM(value) as total")// select bill
            ->selectRaw("DATE_FORMAT(date_due, '$dateFormat') as month_year")
            ->selectSub($this->getQueryWithDepth($model), 'depth')
            ->join("$table as childOrself", function ($join) use ($table, $lft, $rgt) {
                $join->on("$table.$lft", '<=', "childOrself.$lft")// consulta da arvore
                    ->whereRaw("$table.$rgt >= childOrself.$rgt");
            })
            ->join($billTable, "$billTable.category_id", '=', "childOrself.id")
            ->whereBetween('date_due', [$dateStart, $dateEnd])//valos das datas dos bills where campo between primeiro e segundo
            //->whereRaw("({$this->getQueryWithDepth($model)->toSql()}) = 0")// HAVING 
            ->groupBy("$table.id", "$table.name", 'month_year')//
            ->havingRaw("depth = 0")
            ->orderBy("month_year")
            ->orderBy("$table.name");

        // $query->mergeBindings($subQuery);

        // if (DB::connection() instanceof PostgresConnection) {
        //     $dateFormat = $this->getFormatDateByDatabase($dateFormat);
        //     $query = $query->selectRaw("TO_CHAR(date_due, '$dateFormat') as period");// bill  2016-02
        // } elseif (DB::connection() instanceof MySqlConnection) {
        //     $query = $query->selectRaw("DATE_FORMAT(date_due, '$dateFormat') as period");// qual é o total do mes
        // }
        // return $query;
    }

    protected function getQueryWithDepth($model)
    {
        $table = $model->getTable();

        list($lft, $rgt) = [$model->getLftName(), $model->getRgtName()];//

        $alias = '_d';

        return $model
            ->newScopedQuery($alias)
            ->toBase()
            ->selectRaw('count(1) - 1')//calculo depth 
            ->from("{$table} as {$alias}")
            ->whereRaw("{$table}.{$lft} between {$alias}.{$lft} and {$alias}.{$rgt}");
    }

    public function getBalanceByMonth(Carbon $date)
    {
        $dateString = $date->copy()->day($date->daysInMonth)->format('Y-m-d');
        $modelClass = $this->model();

        $subQuery = (new $modelClass)
            ->toBase()//converte para baixo novel
            ->selectRaw("bank_account_id, MAX(statements.id) as maxid") // pegar os ultimos ID
            ->whereRaw("statements.created_at <= '$dateString'")//não tem form
            ->groupBy('bank_account_id');// agrupar os dados 
        //Conta bancaria X 150
        //Conta bancaria Y 140
        //Conta bancaria Z 130
        $result = (new $modelClass)
            ->selectRaw("SUM(statements.balance) as total")
            ->join(\DB::raw("({$subQuery->toSql()}) as s"), 'statements.id', '=', 's.maxid')// alias 
            ->mergeBindings($subQuery)//passa os parametros para query
            //->toSql() ver a query
            ->get();
            //Todo conjunto de contas bancarias
            //Query - somar os saldos únicos das contas
            //Query - selecionar os últimos ids de extrato referente da data
        return $result->first()->total === null ? 0 : $result->first()->total;
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
