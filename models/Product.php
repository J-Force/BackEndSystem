<?php

class Product extends Eloquent{
	protected $table = 'products';
	protected $fillable = array('name', 'description');
	public static $rules = array(
		'name'=>'required',
		'description'=>'required'
	);

	public static function validate($data) {
		return Validator::make($data,static::$rules);
	}
}