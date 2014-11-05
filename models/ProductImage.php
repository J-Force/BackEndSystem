<?php

class ProductImage extends Eloquent{
	protected $table = 'product_images';
	protected $fillable = array('product_id', 'image_id');
	public static $rules = array(
		'product_id'=>'required',
		'image_id'=>'required|unique:product_images,image_id'
	);

	public static function validate($data) {
		return Validator::make($data,static::$rules);
	}

	
}