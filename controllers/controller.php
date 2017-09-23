<?php

namespace Application\Controllers;

class controller{

	public $post = array();
	public $get = array();
	protected $data = array();
	protected $styles = array();
	protected $scripts = array();

	public function __construct(){
		$this->post = $_POST;
		$this->get = $_GET;
		$this->request = $_SERVER['REQUEST_URI'];
		$this->path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$pathParts = explode('/', $this->path);
		$i=0;
		while(isset($pathParts[$i]) && (empty($pathParts[$i]) || preg_match('/\.php/', $pathParts[$i]))){
			$i++;
		}
		$this->ctrl = !empty($pathParts[$i]) ? ucfirst($pathParts[$i]) : 'User';
		$this->act = !empty($pathParts[$i+1]) ? ucfirst($pathParts[$i+1]) : 'Index';
		//проверяем, нужен ли основной шаблон, нужно ли вернуть данные в формате json. Задает формат ответа
		$this->maintemplate = true;
		$this->json = false;
		foreach($this->data as $k => $v){
			if(isset($this->get[$k])){
				$this->$k = $this->get[$k];
			}
			elseif(isset($this->post[$k])){
				$this->$k = $this->post[$k];
			}
		}
	}

	public function output(){
		if($this->json==='true'){
			//если нужен ответ в формате json, главный шаблон не нужен
			//пока что криво работает, надо преобразование в json делать нормальным
			return json_encode($this->content->getData());
		}
		elseif($this->maintemplate === 'false'){
			//если вдруг нужен шаблон контроллера без главного
			return $this->content->getHtml();
		}
		else{
			$view = new View();
			$view->mainController = $this;
			return $view->render('maintemplate');
		}
	}

	public function __set($k, $v){
		$this->data[$k] = $v;
	}

	public function __get($k){
		return isset($this->data[$k]) ? $this->data[$k] : '';
	}

	public function __isset($k){
		return isset($this->data[$k]);
	}

	public function addScript($script){
		$this->scripts[] = __DIR__.'/../views/js/'.$script.'.js';
	}
	public function getScripts(){
		return $this->scripts;
	}

	public function addStyle($style){
		$this->scripts[] = __DIR__.'/../views/css/'.$style.'.css';
	}

	public function getStyles(){
		return $this->styles;
	}

}

?>