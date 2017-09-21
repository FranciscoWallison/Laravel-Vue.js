<?php

namespace SisFin\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use SisFin\Events\BankStoredEvent;
use Prettus\Repository\Criteria\RequestCriteria;
use SisFin\Repositories\BankRepository;
use SisFin\Models\Bank;
use SisFin\Validators\BankValidator;
use Illuminate\Http\UploadedFile;
use SisFin\Presenters\BankPresenter;

/**
 * Class BankRepositoryEloquent
 * @package namespace SisFin\Repositories;
 */
class BankRepositoryEloquent extends BaseRepository implements BankRepository
{
    public function create(array $attributes)
    {
        $logo = isset( $attributes['logo'] ) ? $attributes['logo'] : null;
        $attributes['logo'] = env('BANK_LOGO_DEFAULT');

        $skipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);//escapando presenter estruct->toArray()

        $model = parent::create($attributes);
        $event = new BankStoredEvent($model, $logo);
        event($event);

        $this->skipPresenter = $skipPresenter;//retornando ao valo original

        return $this->parserResult($model);//verifica se tem presenter
    }

    public function update(array $attributes, $id)
    {   

        $logo = null;

        if(isset( $attributes['logo'] ) && $attributes['logo'] instanceof UploadedFile )
        {
            $logo =  $attributes['logo'];
            unset($attributes['logo']);
        }

        $skipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);//escapando presenter estruct->toArray()

        $model = parent::update($attributes, $id);
        $event = new BankStoredEvent($model, $logo);
        event($event);

        $this->skipPresenter = $skipPresenter;//retornando ao valo original

        return $this->parserResult($model);//verifica se tem presenter
    }

    
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Bank::class;
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
        return BankPresenter::class;
    }
}
