<?php

class Images extends Eloquent{
	protected $table = 'images';
	protected $fillable = array('link');

	public function delete()
    {
        // Delete all of the products that have the same ids...
        ProductImage::where("image_id", $this->id)->delete();

        // Finally, delete this image...
        return parent::delete();
    }
}