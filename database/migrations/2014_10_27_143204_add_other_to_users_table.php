<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtherToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('users' , function($table) {
			$table->string('address', 1000);
			$table->date('date_of_birth');
			$table->string('phone',20);
			$table->string('identified_number',20);
			$table->string('interest',3000);
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
			$table->dropColumn(array(
				'address','date_of_birth','phone','identified_number','interest'
			));
		});
	}

}
