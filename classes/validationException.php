<?php
namespace Application\Classes;

class validationException extends \Exception{
	public $statusMessages = array();
	
	public function __construct($msg, $target='msgBox', $type='error'){
		$this->statusMessages[] = array('message'=>$msg, 'target'=> $target, 'type'=>$type);
	}
} 


?>