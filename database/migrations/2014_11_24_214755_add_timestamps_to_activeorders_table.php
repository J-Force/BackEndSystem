<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimestampsToActiveordersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('active_orders',function($t){
			$t->timestamps();
		});
		Schema::table('done_orders',function($t){
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
		Schema::table('active_orders',function($t){
			$t->dropTimestamps();
		});
		Schema::table('done_orders',function($t){
			$t->dropTimestamps();
		});
	}

}
