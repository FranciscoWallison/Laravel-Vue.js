<?php

use Illuminate\Database\Seeder;
use CodeFin\Models\BankAccount;
use CodeFin\Repositories\BankRepository;

class BankAccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $repository = app(BankRepository::class);
        $banks = $repository->all();
        $max = 15;
        $bankAccountId = rand(1, $max);


        factory(BankAccount::class, $max)
        ->make()
        ->each(function($bankAccount) use($banks, $bankAccountId) {
        	$bank = $banks->random();
        	$bankAccount->bank_id = $bank->id;
        	//$bankAccount->associate($bank);

        	$bankAccount->save();
        	
        	if($bankAccountId  == $bankAccount->id)
        	{
        		$bankAccount->default = 1;
        		$bankAccount->save();
        	}
        });
    }
}
