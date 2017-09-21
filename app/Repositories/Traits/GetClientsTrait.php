<?php

namespace SisFin\Repositories\Traits;

use SisFin\Repositories\Interfaces\ClientRepository;

trait GetClientsTrait
{
    protected function getClients()
    {
        /** @var ClientRepository $repository */
        $repository = app(ClientRepository::class);
        $repository->skipPresenter(true);
        return $repository->all();
    }
}