<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTestdataToOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('orders')->insert(array(
			'user_id' =>'1',
			'product_id' =>'1',
			'status' =>'0'
		));
		DB::table('orders')->insert(array(
			'user_id' =>'1',
			'product_id' =>'2',
			'status' =>'0'
		));
		DB::table('orders')->insert(array(
			'user_id' =>'1',
			'product_id' =>'3',
			'status' =>'0'
		));
		DB::table('orders')->insert(array(
			'user_id' =>'1',
			'product_id' =>'4',
			'status' =>'0'
		));
		DB::table('orders')->insert(array(
			'user_id' =>'1',
			'product_id' =>'4',
			'status' =>'1'
		));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	
	}

}
