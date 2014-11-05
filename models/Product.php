<?php

class Product extends Eloquent{
	protected $table = 'products';
	protected $fillable = array('name', 'description', 'cost', 'price', 'weight', 'size', 'sex', 'quantity');
	public static $rules = array(
		'name'=>'required',
		'description'=>'required'
	);

	public static function validate($data) {
		return Validator::make($data,static::$rules);
	}

	public function delete()
    {
        // Delete all of the products that have the same ids...
        Order::where("product_id",$this->id)->delete();
        ProductImage::where("product_id", $this->id)->delete();

        // Finally, delete this image...
        return parent::delete();
    }
}