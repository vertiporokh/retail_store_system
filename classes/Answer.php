<?php
namespace Application\Classes;

class Answer{
	private $html='';
	private $data=array();

	public function __construct($html='', $data = array()){
		$this->html = $html;
		$this->data = $data;
	}

	public function __set($k, $v){
		$this->data[$k] = $v;
	}

	public function __get($k){
		return isset($this->data[$k]) ? $this->data[$k] : false;
	}

	public function __isset($k){
		return isset($this->data[$k]);
	}

	public function getHtml(){
		return $this->html;
	}
	public function setHtml($html){
		
		return $this->html = $html;
	}

	public function getData(){
		return $this->data;
	}
	public function statusMessage($msg, $msgtype='success'){
		//задаем сообщение и его тип. Возможные типы: success, warning, error
		$this->status_message = array(	'type' 		=> 	$msgtype,
										'message'	=>	$msg);
	}
	public function redirect($rout){
		$this->_route = $route;
		return $this;
	}

}


?>