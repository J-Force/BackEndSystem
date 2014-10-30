<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsImageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('news_image', function($table) {
			$table->increments('id');
			$table->integer('news_id')->unsigned();
			$table->integer('image_id')->unsigned();
			$table->foreign('news_id')->references('id')->on('news');
			$table->foreign('image_id')->references('id')->on('images');
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
		Schema::drop('news_image');
	}

}
