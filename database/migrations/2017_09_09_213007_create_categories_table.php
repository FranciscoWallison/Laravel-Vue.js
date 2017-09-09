<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateCategoriesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//TO::DO https://laravel.com/docs/5.3/eloquent#soft-deleting
		/*
		* Qundo vc deleta uma chave pai as filhas iram juntas 
		* Usando Soft Delete evitarar a perca de todos os campos 
		*/
		
		Schema::create('categories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');// left right parent_id

            //Campos NESTED SET MODEL
            NestedSet::columns($table);

            // Relacionamento multitenancy
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');
            // DB::select('DESCRIBE categories')
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}

}
