<?php

namespace CodeFin\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFin\Repositories\StatementRepository;
use CodeFin\Models\Statement;
use CodeFin\Validators\StatementValidator;
use Carbon\Carbon;

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

        $subQuery = $this->getQueryWithDepth($model);
        $query = $model
            ->addSelect("$table.id")
            ->addSelect("$table.name")
            ->selectRaw("SUM(value) as total")
            ->join("$table as childorself", function ($join) use ($table, $lft, $rgt) {
                $join->on("$table.$lft", '<=', "childorself.$lft")
                    ->whereRaw("$table.$rgt >= childorself.$rgt");
            })
            ->join($billTable, "$billTable.category_id", '=', "childorself.id")
            ->whereBetween('date_due', [$dateStart, $dateEnd])
            ->whereRaw("({$this->getQueryWithDepth($model)->toSql()}) = 0")
            ->groupBy("$table.id", "$table.name", 'period')
            ->orderBy("period")
            ->orderBy("$table.name");

        $query->mergeBindings($subQuery);

        if (DB::connection() instanceof PostgresConnection) {
            $dateFormat = $this->getFormatDateByDatabase($dateFormat);
            $query = $query->selectRaw("TO_CHAR(date_due, '$dateFormat') as period");
        } elseif (DB::connection() instanceof MySqlConnection) {
            $query = $query->selectRaw("DATE_FORMAT(date_due, '$dateFormat') as period");
        }
        return $query;
    }
    public function getBalanceByMonth(Carbon $date)
    {
        $dateString = $date->copy()->day($date->daysInMonth)->format('Y-m-d');
        $modelClass = $this->model();

        $subQuery = (new $modelClass)
            ->toBase()//converte para baixo novel
            ->selectRaw("bank_account_id, MAX(statements.id) as maxid") // pegar os ultimos ID
            ->whereRaw("statements.created_at <= '$dateString'")//não tem form
            ->groupBy('bank_account_id');
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
