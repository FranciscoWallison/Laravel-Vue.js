<?php

namespace CodeFin\Listeners;

use CodeFin\Events\BankStoredEvent;
use CodeFin\Repositories\BankRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BankLogoUploadListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(BankRepository $repository)
    {
        //
        $this->repository = $repository;
    }

    /**
     * Handle the event.
     *
     * @param  BankStoredEvent  $event
     * @return void
     */
    public function handle(BankStoredEvent $event)
    {
        //upload do logo
        $bank = $event->getBank();
        $logo = $event->getLogo();


        $name = md5(time()).'.'.$logo->guessExtension();

        $destFile = Bank::logoDir();

        \Storage::disk('public')->putFileAs($destFile, $logo, $name);

        $this->repository->update([
                'logo' => $name], 
                $bank->id
                );

    }
}
