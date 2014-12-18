<?php

class Promotion extends Eloquent{
	protected $table = 'promotions';

	protected $fillable = array('start_date','expire_date','title','description');

}