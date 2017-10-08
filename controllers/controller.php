<?php
namespace Application\Controllers;

use Application\Classes\Answer;
use Application\Controllers\View;
use Application\Controllers\MainController;

abstract class controller{
	protected $answer;
	protected $view;
	protected $maincontroller;

	public function __construct(){
		$this->view = new View();
		$this->answer = new Answer();
		$this->maincontroller = mainController::getInstance();
	}

	public function actionIndex(){
		return $this->actionGetAll();
	}

	public function actionGetAll(){

	}
}


?>