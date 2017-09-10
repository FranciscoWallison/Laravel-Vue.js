<?php 

namespace CodeFin\Repositories;

trait GetClientsTrait
{
	private function getClients()
    {
        /** @var \codeFin\Repositories\ClientRepository $repository */
        $repository = app(ClientRepository::class);
        $repository->skipPresenter(true);//valores do tipo toArray()
        return $repository->all();
    }
}