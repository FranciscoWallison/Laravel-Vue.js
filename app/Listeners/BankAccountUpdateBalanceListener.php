<?php

namespace CodeFin\Listeners;

use CodeFin\Events\BillStoredEvent;
use CodeFin\Models\BillPay;
use CodeFin\Repositories\BankAccountRepository;
use CodeFin\Repositories\StatementRepository;

class BankAccountUpdateBalanceListener
{
    /**
     * @var BankAccountRepository
     */
    private $bankAccountRepository;
    /**
     * @var StatementRepository
     */
    private $statementRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(BankAccountRepository $bankAccountRepository, StatementRepository $statementRepository)
    {
        $this->bankAccountRepository = $bankAccountRepository;
        $this->bankAccountRepository->skipPresenter(true);

        $this->statementRepository = $statementRepository;
        $this->statementRepository->skipPresenter(true);
    }

    /**
     * Handle the event.
     *
     * @param  BillStoredEvent $event
     * @return void
     */
    public function handle(BillStoredEvent $event)
    {
        $model = $event->getModel();
        $bankAccountId = $model->bank_account_id;
        $value = $this->getValue($event);
        if ($value) {
            $bankAccount = $this->bankAccountRepository->addBalance($bankAccountId, $value);
            $this->statementRepository->create([
                'statementable' => $model,
                'value' => $value,
                'balance' => $bankAccount->balance,
                'bank_account_id' => $bankAccount->id,
            ]);
        }
    }
    /*
    * definir qual o valo esta no extrato
    */
    protected function getValue(BillStoredEvent $event)
    {
        $model = $event->getModel();
        $modelOld = $event->getModelOld();

        $value = $model->value; // valor atual 
        $valueOld = $modelOld ? $modelOld->value : $model->value; // valor antigo
        $doneOld = $modelOld ? $modelOld->done : false;//

        if ($value != $valueOld) { // valor da conta alterado
            if ($model->done == $modelOld->done && $model->done) {  // conta continua paga
                return $model instanceof BillPay ? $valueOld - $value : $value - $valueOld;
            }
        }
        if ($model->done != $doneOld) {// verificando o tipo de conta 
            if ($model->done) { // antes não estava paga
                return $model instanceof BillPay ? -$value : $value;
            } else { // antes estava paga
                return $model instanceof BillPay ? $valueOld : -$valueOld;
            }
        }

        return 0;
    }
}
