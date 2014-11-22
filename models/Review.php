<?php
class Review extends Eloquent {

	protected $table = 'review';

	protected $primaryKey = 'id';

	protected $fillable = array('user_id','product_id','comment_id');
}