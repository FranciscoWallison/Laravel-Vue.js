<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClientsToCategoryExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('category_expenses', function (Blueprint $table) {
            //
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');

        });           
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        
        Schema::table('category_expenses', function (Blueprint $table) {
            //
            $table->dropForeign('category_expenses_client_id_foreign'); //table_name_chave_foreign
            $table->dropColumn('client_id');
        });
    }
}
