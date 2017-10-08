<?php
namespace Application\Models;

use Application\Models\abstractModel;
use Application\Classes\Db;

class UserRights extends abstractModel{

protected 	static $table = 'user_rights';
public 		static $required_data = array(	'id'				=>false,
											'user_id'			=>true,
											'object_id'			=>false,
											'object_type' 		=>true,
											'right_code'		=>true,
											'value'				=>true);

}



?>