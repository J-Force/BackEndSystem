<?php

class Category extends Eloquent{
	protected $table = 'category';
	protected $fillable = array('name');
	public static $rules = array(
		'name'=>'required',
	);

	public static function validate($data) {
		return Validator::make($data,static::$rules);
	}

	public function delete()
    {
        // Delete all of the products that have the same ids...
        Product::where("category_id",$this->id)->update(array('category_id' => 4));;
        // Finally, delete this image...
        return parent::delete();
    }
}