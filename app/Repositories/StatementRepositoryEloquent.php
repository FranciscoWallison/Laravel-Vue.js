<?php

namespace CodeFin\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFin\Repositories\StatementRepository;
use CodeFin\Models\Statement;
use CodeFin\Validators\StatementValidator;

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

    public function getBalanceByMonth(Carbon $date)
    {
        $dateString = $date->copy()->day($date->daysInMonth)->format('Y-m-d');
        $modelClass = $this->model();

        /*
         * Qual é o id e o ultimo extrato
         * 
         */
        $subQuery = (new $modelClass)
            ->toBase()
            ->selectRaw("bank_account_id, MAX(statements.id) as maxid") // pegar os ultimos ID
            ->whereRaw("statements.created_at <= '$dateString'")//não tem form
            ->groupBy('bank_account_id');

        $result = (new $modelClass)
            ->selectRaw("SUM(statements.balance) as total")
            ->join(\DB::raw("({$subQuery->toSql()}) as s"), 'statements.id', '=', 's.maxid')
            ->mergeBindings($subQuery)
            ->get();
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
