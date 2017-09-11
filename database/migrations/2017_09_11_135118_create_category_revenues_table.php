<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryRevenuesTable extends Migration
{
$table->increments('id');
            $table->string('name');

            NestedSet::columns($table);

            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->reference('id')->on('clients');
            $table->timestamps();
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

            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->reference('id')->on('clients');
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
