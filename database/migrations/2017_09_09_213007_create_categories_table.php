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
		
		/* 
		* Foi trasferido a logia para as tabelas 
		* category_revenues e category_expenses
		**/
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//Schema::drop('categories');
	}

}
