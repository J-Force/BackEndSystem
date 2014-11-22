<?php
class Comment extends Eloquent {

	protected $table = 'comment';

	protected $primaryKey = 'id';

	protected $fillable = array('text');
}