<?php
namespace Application\Classes;

use Application\Classes\EmptyObject;
use Application\Classes\MagicObject;
use Application\Classes\Logger;

class DbInsideExt extends DbInside{

	private $className = 'stdClass';

	public function __construct($mysqli, $className = 'stdClass') {	
		parent::__construct($mysqli);
		$this->className = $className;
	}
	public function resultObj($index = false, $className='stdClass') {
    		if(strtoupper($className) == 'STDCLASS'){
    			$className = $this->className;
    		}
    		return $this->_getResult('object', $index, $className);
  	}

}


?>