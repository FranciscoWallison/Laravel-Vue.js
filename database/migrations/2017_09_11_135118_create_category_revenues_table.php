<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class CreateCategoryRevenuesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_revenues', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            NestedSet::columns($table);

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
		Schema::drop('category_revenues');
	}

}
