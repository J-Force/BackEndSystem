<?php
 
use Zizaco\Entrust\EntrustRole;
 
class Role extends EntrustRole {
	protected $name = array('Admin' , 'User');
	protected $permissions = array('can_read' , 'can_edit');;
}