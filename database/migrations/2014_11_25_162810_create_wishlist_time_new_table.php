<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWishlistTimeNewTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('wishlist_time',function($table){
			$table->increments('id');
			$table->integer('wish_id')->unsigned();
			$table->foreign('wish_id')->references('id')->on('wishlist');
			$table->integer('quantity');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('wishlist_time');
	}

}
