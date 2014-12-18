<?php
class Done extends Eloquent {
	protected $table = 'done_orders';
	protected $fillable = array('user_id','order_id','payment_id','total_price','shipment_cost','total_net_price','ship_id');
	protected $primaryKey ='id';
}