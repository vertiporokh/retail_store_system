<?php
	use Application\Classes\Config;
	use Application\Classes\Log;
	use Application\Controllers\View;
	use Application\Classes\E404Exception;
	use Application\Classes\validationException;
	use Application\Controllers\Controller;
	use Application\Classes\Answer;

	require_once __DIR__.'/autoload.php';
	
	$mainController = new Controller();

	try{
		$controllerClassName = 'Application\Controllers\\'.$mainController->ctrl;
		$method = 'action'.$mainController->act;
		$controller = new $controllerClassName;
		$mainController->content = $controller->$method();
		echo $mainController->output();
	}
	catch(validationException $e){
		var_dump($e);
	}
	catch(\PDOException $e){
		//временно, переделать
		var_dump($e);
	}
	catch(E404Exception $e){
		//временно, переделать
		$log = new Log();
		$log->write($e);
		$view = new View();
		$view->error = $e;
		$mainController->content = new Answer($view->render('error404'), $e);
		echo $mainController->output();
	}
	catch(\Exception $e){
		//временно, переделать
		$log = new Log();
		$log->write($e);
		$view = new View();
		$view->error = $e;
		$mainController->content = new Answer($view->render('error'), $e);
		echo $mainController->output();
	}


?>