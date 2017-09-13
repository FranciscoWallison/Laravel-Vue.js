<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    public function run()
    {
        $this->call(CategoryExpensesTableSeeder::class);
        $this->call(CategoryRevenuesTableSeeder::class);
    }

}
