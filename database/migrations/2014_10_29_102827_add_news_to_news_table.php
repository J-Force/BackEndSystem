<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewsToNewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('news')->insert(array(
			'title' =>'ร้านเปิดทำการ',
			'description' =>'ร้านเปิดอย่างเป็นทางการในวันที่ 29 ตุลาคม 2014',
		));
		DB::table('news')->insert(array(
			'title' =>'โปรโมชั่นฉลองเปิดร้าน',
			'description' =>'ลดราคาสิ้นค้าทุกชนิด20%',
		));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::delete('delete from news where title = \'ร้านเปิดทำการ\' or title = \'โปรโมชั่นฉลองเปิดร้าน\'');
	}

}