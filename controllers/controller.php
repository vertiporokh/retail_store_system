<?php
namespace Application\Controllers;

use Application\Classes\Answer;
use Application\Controllers\View;

class controller{
	protected $answer;
	protected $view;

	public function __construct(){
		$this->view = new View();
		$this->answer = new Answer();
	}

	public function actionIndex(){
		return $this->actionGetAll();
	}

	public function actionGetAll(){

	}

	public function sendAnswer(){
		$this->answer->setHtml($this->view->view);
		return $this->answer;
	}
}


?>