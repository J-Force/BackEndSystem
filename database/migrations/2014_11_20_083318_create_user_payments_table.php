<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('user_payment',function($t){
			$t->increments('id');
			$t->integer('user_id')->unsigned();
			$t->foreign('user_id')->references('id')->on('users');
			$t->integer('payment_id')->unsigned();
			$t->foreign('payment_id')->references('id')->on('payments');
			$t->string('credit_number',16);
			$t->string('credit_name',255);
			$t->string('expire_month',2);
			$t->string('expire_year',2);
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
		Schema::drop('user_payment');
	}

}
