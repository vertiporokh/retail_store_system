<?php
namespace Application\Controllers;

class view
		implements \Countable			
{
	
	public $data = [];
	public $view = '';

	public function data($dataname, $data){
		$this->data[$dataname] = $data;
	}

	public function __set($dataname, $data){
		$this->data[$dataname] = $data;
	}

	public function __get($dataname){
		return $this->data[$dataname];
	}

	public function render($viewname){
		foreach ($this->data as $key => $value) {
			$$key = $value;
		}
		if(file_exists(__DIR__.'/../views/'.$viewname.'.php')){
			$this->view = __DIR__.'/../views/'.$viewname.'.php';
		}elseif(file_exists($viewname)){
			$this->view = $viewname;
		}
		ob_start();
		include $this->view;
		/*делаем что-тио еще*/
		$this->view = ob_get_contents();
		ob_end_clean();
		return $this->view;
	}

	public function count(){
		return count($this->data);
	}

	public function next(){
		return next($this->data);
	}

	public function key(){
		current($this->data);
		$key = key($this->data);
		return $key;
	}

	public function valid(){
		$key = key($this->data);
		return ($key !== NULL || $key !== FALSE);
	}

	public function current(){
		return current($this->data);
	}
}


?>