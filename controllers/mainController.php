<?php

namespace Application\Controllers;

class mainController{

	public $post = array();
	public $get = array();
	protected $data = array();
	protected $styles = array();
	protected $scripts = array();
	private static $_instance = null;

	private function __construct(){
			$this->post = $_POST;
			$this->get = $_GET;
			$this->host = $_SERVER['HTTP_HOST'];
			$this->request = $_SERVER['REQUEST_URI'];
			$this->path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
			$pathParts = explode('/', $this->path);
			$i=0;
			while(isset($pathParts[$i]) && (empty($pathParts[$i]) || preg_match('/\.php/', $pathParts[$i]))){
				$i++;
			}
			$this->ctrl = !empty($pathParts[$i]) ? ucfirst($pathParts[$i]) : 'User';
			$this->act = !empty($pathParts[$i+1]) ? ucfirst($pathParts[$i+1]) : 'Index';
			$this->obj_id = (!empty($pathParts[$i+2]) && (int)$pathParts[$i+2]>0) ? (int)$pathParts[$i+2] : false;
			//проверяем, авторизован ли пользователь
			if(!isset($_SESSION['user_id'])&& ($this->ctrl != 'User' && ($this->act != 'Login' || $this->act != 'Register'))){
				header('Location: /user/login');
			}
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

	public static function getinstance(){
		if(is_null(self::$_instance)){
			return self::$_instance = new self;
		}
		return self::$_instance;
	}

	public function output(){
		if($this->json==='true'){
			//если нужен ответ в формате json, главный шаблон не нужен
			//пока что криво работает, надо преобразование в json делать нормальным
			$data = $this->content->getData();
			return json_encode($data, true);
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

	public function redirect(){
		
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
		$this->scripts[] = array('path'=>__DIR__.'/../views/js/'.$script.'.js', 'link'=>'/views/js/'.$script.'.js');
	}
	public function getScripts($type='link'){
		$scripts=array();
		foreach($this->scripts as $script)
		{
			$scripts[] = $script[$type];
		}
		return $scripts;
	}

	public function addStyle($style){
		$this->styles[] =array('path'=> __DIR__.'/../views/css/'.$style.'.css', 'link'=>'/views/css/'.$style.'.css');
	}

	public function getStyles($type='link'){
		$styles=array();
		foreach($this->styles as $style)
		{
			$styles[] = $style[$type];
		}
		return $styles;
	}

}

?>