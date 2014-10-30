<?php

class Order extends Eloquent{
	protected $table = 'orders';

	protected $fillable = array( 'user_id' , 'product_id' , 'status' );
	
	protected $primaryKey = 'id';

}