<?php

class Bill extends Eloquent{
	protected $table = 'bills';

	protected $fillable = array( 'id','user_id' , 'total_price' );
	
	protected $primaryKey = 'id';

}