<?php

class Userwish extends Eloquent{
	protected $table = 'user_wish';

	protected $fillable = array( 'user_id' , 'wish_id');
	
	protected $primaryKey = 'id';

}