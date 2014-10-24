<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products',function($table){
			$table->increments('id');
			$table->string('name');
			$table->decimal('cost', 5, 2);
			$table->decimal('price', 5, 2);
			$table->string('description');
			$table->decimal('weight', 5, 2);
			$table->string('size',4);
			$table->string('sex',1);
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
		Schema::drop('products');
	}

}
