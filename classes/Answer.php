<?php
namespace Application\Classes;

class Answer{
	private $html='';
	private $data=array();
	private $statusMessages = array();

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
		$result = $this->data;
		$result['statusMessages'] = $this->statusMessages;
		return $result;
	}
	public function statusMessage($msg, $target='message_box', $msgtype='success'){
		//задаем сообщение и его тип. Возможные типы: success, warning, error
		$this->statusMessages[] = array(	'type' 		=> 	$msgtype,
											'message'	=>	$msg,
											'target'	=>	$target);
	}
	public function redirect($rout){
		$this->_route = $route;
		return $this;
	}

}


?>