<?php

use Illuminate\Database\Seeder;
use SisFin\Models\BillReceive;
use SisFin\Repositories\BillReceiveRepository;

class BillReceivesTableSeeder extends Seeder
{
    use \SisFin\Repositories\GetClientsTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = $this->getClients();

        $repository = app(BillReceiveRepository::class);
        factory(BillReceive::class, 200)
            ->make()
            ->each(function ($billReceive) use ($clients, $repository) {
                $client = $clients->random();
                \Landlord::addTenant($client);
                $bankAccount                    = $client->bankAccounts->random();
                $category                       = $client->categoryRevenues->random();
                $billReceive->client_id         = $client->id;
                $billReceive->bank_account_id   = $bankAccount->id;
                $billReceive->category_id       = $category->id;
                $data                           = $billReceive->toArray();//transformando em array o model
                $repository->create($data);
            });
    }

}
