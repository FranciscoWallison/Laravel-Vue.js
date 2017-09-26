<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//tabelas de faturas 
		Schema::create('orders', function(Blueprint $table) {
            $table->increments('id');

            $table->date('date_due');//data de vencimento 
            $table->dateTime('payment_date')->nullable();// data que ela fez o pagamentos
            $table->string('payment_url');// url iugu caso de boleto
            $table->string('code');//id da invos da iugu
            $table->smallInteger('status');//pendente ou pago
            $table->float('value');

            $table->integer('subscription_id')->unsigned();
            $table->foreign('subscription_id')->references('id')->on('subscriptions');

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
		Schema::drop('orders');
	}

}
