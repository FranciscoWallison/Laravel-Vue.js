<?php

use Illuminate\Database\Seeder;
use CodeFin\Models\CategoryExpense;
use CodeFin\Repositories\CategoryExpenseRepository;

class CategoryExpensesTableSeeder extends Seeder
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

    	factory(CategoryExpense::class, 30)
    		->make()
    		->each(function($category) use($clients){
    			$client = $clients->random();
    			$category->client_id = $client->id;
    			$category->save();
    		});

    		$categoriesRoot = $this->getCategoriesRoot();

    		foreach ($categoriesRoot as $root) {
    			
		    	factory(CategoryExpense::class, 3)
		    		->make()
		    		->each(function($child) use($root){

		    			$child->client_id = $root->client_id; // erro mult-tenacy
		    			$child->save();

		    			//associando ao pai
		    			$child->parent()->associate($root);
		    			$child->save();
		    		});
    		}
    }

    private function getCategoriesRoot()
    {
        /** @var \codeFin\Repositories\CategoryExpenseRepository $repository */
        $repository = app(CategoryExpenseRepository::class);
        $repository->skipPresenter(true);//valores do tipo toArray()
        return $repository->all();
    }
}
