<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProducts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('products')->insert(array(
			'name' =>'iceza',
			'cost' =>'15.496',
			'price' =>'200',
			'description' =>'hello test za 123',
			'weight' =>'10.25',
			'size' =>'S',
			'sex' =>'M',
			'quantity' =>'20',
		));
		DB::table('products')->insert(array(
			'name' =>'iceza2',
			'cost' =>'15.496',
			'price' =>'200',
			'description' =>'hello test za 123',
			'weight' =>'10.25',
			'size' =>'S',
			'sex' =>'M',
			'quantity' =>'20',
		));
		DB::table('products')->insert(array(
			'name' =>'iceza3',
			'cost' =>'15.496',
			'price' =>'200',
			'description' =>'hello test za 123',
			'weight' =>'10.25',
			'size' =>'S',
			'sex' =>'M',
			'quantity' =>'20',
		));
		DB::table('products')->insert(array(
			'name' =>'iceza4',
			'cost' =>'15.496',
			'price' =>'200',
			'description' =>'hello test za 123',
			'weight' =>'10.25',
			'size' =>'S',
			'sex' =>'M',
			'quantity' =>'20',
		));
		DB::table('products')->insert(array(
			'name' =>'iceza5',
			'cost' =>'15.496',
			'price' =>'200',
			'description' =>'hello test za 123',
			'weight' =>'10.25',
			'size' =>'S',
			'sex' =>'M',
			'quantity' =>'20',
		));
		DB::table('products')->insert(array(
			'name' =>'iceza6',
			'cost' =>'15.496',
			'price' =>'200',
			'description' =>'hello test za 123',
			'weight' =>'10.25',
			'size' =>'S',
			'sex' =>'M',
			'quantity' =>'20',
		));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
