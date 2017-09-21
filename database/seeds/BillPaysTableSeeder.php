<?php

use Illuminate\Database\Seeder;
use SisFin\Models\BillPay;
use SisFin\Repositories\BillPayRepository;

class BillPaysTableSeeder extends Seeder
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
        $clients = $this->getClients();

        $repository = app(BillPayRepository::class);
        factory(\SisFin\Models\BillPay::class, 200)
            ->make()
            ->each(function($billPay) use ($clients, $repository){
                $client = $clients->random();
                \Landlord::addTenant($client);// ser acresentado no extrato
                $bankAccount                = $client->bankAccounts->random();
                $category                   = $client->categoryExpenses->random();
                $billPay->client_id         = $client->id;
                $billPay->bank_account_id   = $bankAccount->id;
                $billPay->category_id       = $category->id;
                $data = $billPay->toArray();//transformando em array o model
                $repository->create($data);
            });
    }
}
