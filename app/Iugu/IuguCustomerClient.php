<?php

namespace SisFin\Iugu;
use SisFin\Iugu\Exceptions\IuguCustomerException;
use SisFin\Repositories\ClientRepository;

class IuguCustomerClient
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * IuguCustomerClient constructor.
     * @param ClientRepository $clientRepository
     */
    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function create(array $attributes)
    {
        /*
        * Pegando apenas o nome e e-mail
        */
        $result = \Iugu_Customer::create(array_only($attributes,['name','email']));


        if(isset($result['errors'])){
            throw new IuguCustomerException($result['errors']); //erros
        }

        /* 
        * Apois o cadastrado criado 
        * EXEMPLO DE RETORNO na documentação da IUGU
        */
        
        $this->clientRepository->update(['code' => $result['id']],$attributes['id']);
        return $result;
    }
}