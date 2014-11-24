<?php
class Active extends Eloquent {
	protected $table = 'active_orders';
	protected $fillable = array('user_id','order_id');
	protected $primaryKey ='id';
}