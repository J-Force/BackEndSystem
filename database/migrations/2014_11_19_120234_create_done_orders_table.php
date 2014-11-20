<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoneOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('done_orders',function($t){
			$t->increments('id');
			$t->integer('order_id')->unsigned();
			$t->foreign('order_id')->references('id')->on('orders');
			$t->integer('user_id')->unsigned();
			$t->foreign('user_id')->references('id')->on('users');
			$t->integer('payment_id')->unsigned();
			$t->foreign('payment_id')->references('id')->on('payments');
			$t->float('total_price');
			$t->float('shipment_cost');
			$t->float('total_net_price');

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
		Schema::drop('done_orders');
	}

}
