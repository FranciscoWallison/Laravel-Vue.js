<?php

use Illuminate\Database\Seeder;
use CodeFin\Models\Category;
use CodeFin\Repositories\CategoryRepository;

class CategoriesTableSeeder extends Seeder
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

    	factory(Category::class, 30)
    		->make()
    		->each(function($category) use($clients){
    			$client = $clients->random();
    			$category->client_id = $client->id;
    			$category->save();
    		});

    		$categoriesRoot = $this->getCategoriesRoot();

    		foreach ($categoriesRoot as $root) {
    			
		    	factory(Category::class, 3)
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
        /** @var \codeFin\Repositories\CategoryRepository $repository */
        $repository = app(CategoryRepository::class);
        $repository->skipPresenter(true);//valores do tipo toArray()
        return $repository->all();
    }
}
