<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //cirando tenancy
        factory(\SisFin\Models\Client::class, 5)->create();
    }
}
