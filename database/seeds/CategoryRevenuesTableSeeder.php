<?php

use Illuminate\Database\Seeder;
use CodeFin\Models\CategoryRevenue;
use CodeFin\Repositories\CategoryRevenueRepository;

class CategoryRevenuesTableSeeder extends Seeder
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

    	factory(CategoryRevenue::class, 30)
    		->make()
    		->each(function($category) use($clients){
    			$client = $clients->random();
    			$category->client_id = $client->id;
    			$category->save();
    		});

    		$categoriesRoot = $this->getCategoriesRoot();

    		foreach ($categoriesRoot as $root) {
    			
		    	factory(CategoryRevenue::class, 3)
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
        /** @var \codeFin\Repositories\CategoryRevenueRepository $repository */
        $repository = app(CategoryRevenueRepository::class);
        $repository->skipPresenter(true);//valores do tipo toArray()
        return $repository->all();
    }
}
