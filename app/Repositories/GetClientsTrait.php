<?php 

namespace SisFin\Repositories;
use SisFin\Repositories\ClientRepository;

trait GetClientsTrait
{
	private function getClients()
    {
        /** @var \SisFin\Repositories\ClientRepository $repository */
        $repository = app(ClientRepository::class);
        $repository->skipPresenter(true);//valores do tipo toArray()
        return $repository->all();
    }
}