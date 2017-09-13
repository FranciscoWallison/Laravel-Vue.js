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
        factory(BillPay::class, 200)
        	->make()
        	->each(function($billPay) use($clients){
        		$client = $clients->random();
        		$billPay->client_id = $client->id;
        		$billPay->save();
        	});
    }
}
