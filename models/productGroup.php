<?php
namespace Application\Models;

class productGroup extends abstractModel{
/**
class ProductGroup
@property $id
@property $name
@property $description
@property $parent_id 

**/
protected 	static $table = 'product_group';
public 		static $required_data = array(	'id'			=>false,
											'name'			=>true,
											'description' 	=>false,
											'parent_id'		=>false);



}




?>