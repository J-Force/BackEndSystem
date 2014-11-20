<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('shipment',function($t){
			$t->increments('id');
			$t->string('name',100);
			$t->float('cost');
		});

		Schema::table('done_orders',function($t){
			$t->integer('ship_id')->unsigned();
			$t->foreign('ship_id')->references('id')->on('shipment');
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
		Schema::drop('shipment');

		Schema::table('done_orders',function($t){
			$t->dropColumn('ship_id');
		});
	}

}
