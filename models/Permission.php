<?php
 
use Zizaco\Entrust\EntrustPermission;
 
class Permission extends EntrustPermission {
	protected $name = array('can_read' , 'can_edit');
	protected $display_name = array('Can Read Data','Can Edit Data');
}
