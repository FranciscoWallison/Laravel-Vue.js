<?php

use Illuminate\Database\Seeder;
use SisFin\Models\BankAccount;
use SisFin\Repositories\BankRepository;
use SisFin\Repositories\ClientRepository;

class BankAccountTableSeeder extends Seeder
{

    use \SisFin\Repositories\GetClientsTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $banks = $this->getBanks();  //coleção de bancos
        $clients = $this->getClients();
        $max = 50;
        $bankAccountId = rand(1, $max);


        factory(BankAccount::class, $max)
        ->make()
        ->each(function($bankAccount) use ($banks, $bankAccountId, $clients) {
        	$bank = $banks->random();
            $client = $clients->random();

        	$bankAccount->bank_id = $bank->id;
            $bankAccount->client_id = $client->id;
        	//$bankAccount->associate($bank);

        	$bankAccount->save();
        	
        	if($bankAccountId  == $bankAccount->id) // conta padrão
        	{
        		$bankAccount->default = 1;
        		$bankAccount->save();
        	}
        });
    }

    private function getBanks()
    {
        /** @var \SisFin\Repositories\BankRepository $repository */
        $repository = app(BankRepository::class);
        $repository->skipPresenter(true);//valores do tipo toArray()
        return $repository->all();
    }

}
