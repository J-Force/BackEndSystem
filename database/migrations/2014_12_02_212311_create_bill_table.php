<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('bills',function($t){
			$t->integer('id');
			$t->primary('id');
			$t->integer('user_id')->unsigned();
			$t->foreign('user_id')->references('id')->on('users');
			$t->float('total_price');
			$t->timestamps();
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
		Schema::drop('bills');
	}

}
