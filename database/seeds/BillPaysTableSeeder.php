<?php

use Illuminate\Database\Seeder;
use CodeFin\Models\BillPay;

class BillPaysTableSeeder extends Seeder
{
	use \CodeFin\Repositories\GetClientsTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $clients = $this->getClients();

        factory(\CodeFin\Models\BillPay::class, 200)
            ->make()
            ->each(function($billPay) use ($clients){
                $client = $clients->random();
                $bankAccount                = $client->bankAccounts->random();
                $category                   = $client->categoryExpenses->random();
                $billPay->client_id         = $client->id;
                $billPay->bank_account_id   = $bankAccount->id;
                $billPay->category_id       = $category->id;
                $billPay->save();
            });
    }
}
