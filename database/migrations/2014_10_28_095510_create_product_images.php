<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_images',function($table){
			$table->integer('product_id')->unsigned();
			$table->integer('image_id')->unsigned();

			$table->foreign('product_id')->references('id')->on('products');
			$table->foreign('image_id')->references('id')->on('images');
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
		Schema::drop('product_images');
	}

}
