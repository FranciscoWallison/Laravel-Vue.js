<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClientsTableSeeder::class);// precisa estar antes para poder alimenta os usuarios
        $this->call(UsersTableSeeder::class);
        $this->call(BankAccountTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(BillPaysTableSeeder::class);
        $this->call(BillReceivesTableSeeder::class);
        $this->call(PlansTableSeeder::class);
        
        //$this->call(BanksTableSeeder::class); foi definida na migrção a criação do seu seed
    }
}
