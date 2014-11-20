<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActiveOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('active_orders',function($t){
			$t->increments('id');
			$t->integer('user_id')->unsigned();
			$t->foreign('user_id')->references('id')->on('users');
			$t->integer('order_id')->unsigned();
			$t->foreign('order_id')->references('id')->on('orders');
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
		Schema::drop('active_orders');
	}

}
