<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNameToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('users' , function($table) {
			$table->string('sex',10);
			$table->string('first_name',100);
			$table->string('last_name',100);
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
		Schema::table('users' , function($table) {
			$table->dropColumn(array('sex','first_name','last_name'));
		});
	}

}
