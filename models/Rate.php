<?php
class Rate extends Eloquent {
	protected $table = 'rate';

	protected $primaryKey = 'id';

	protected $fillable = array('user_id','product_id','rate');
}