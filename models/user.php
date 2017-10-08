<?php
namespace Application\Models;

use Application\Models\abstractModel;
use Application\Classes\DB;

class User extends abstractModel{
	protected 	static $table = 'user';
	public 		static $required_data = array(	'id'				=>false,
												'name'				=>true,
												'job'				=>true,
												'login' 			=>true,
												'pass'				=>true,
												'description'		=>false,
												'role'				=>false);
	protected 	$user_rights 	= 	array();
	protected	$contacts		=	array();

	/*public function __construct($user_id = false){
		if((int)$user_id>0){
			$result = self::get(array('id'=>$user_id));
			if(isset($result[0]) && $result[0] instanceof self){
				foreach(self::$required_data as $k => $v){
					$this->$k = $result[0]->$k;
				}				
			}
		}
		return $this;
	}*/

}

?>