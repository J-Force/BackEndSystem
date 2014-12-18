<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimestampsToWishlistTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('wishlist',function($t){
			$t->timestamps();
		});

		Schema::table('user_wish',function($t){
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
		Schema::table('wishlist',function($t){
			$t->dropTimestamps();
		});

		Schema::table('user_wish',function($t){
			$t->dropTimestamps();
		});
	}

}
