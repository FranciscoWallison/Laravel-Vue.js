<?php

namespace CodeFin\Listeners;

use Prettus\Repository\Events\RepositoryEventBase;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use CodeFin\Repositories\BankAccountRepository;

class BankAccountSetDefaultListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(BankAccountRepository $repository)
    {
        //
        $this->repository = $repository;
        $this->repository->skipPresenter(true);
    }

    /**
     * Handle the event.
     *
     * @param  RepositoryEventBase  $event
     * @return void
     */
    public function handle(RepositoryEventBase $event)
    {
        //
        $model = $event->getModel();

        // se não for default retorna valor vazio
        if(!$model->default){
            return;
        } 
        
        $collection = $this->repository
            ->findByField('default', true)
            ->filter(function($value, $key) use($model){
                return $model->id != $value->id;
            });

        $bankAccountDefault = $collection->first();
        if($bankAccountDefault)
        {
            $this->repository->update(['default' => false], $bankAccountDefault->id);
        }

    }
}
