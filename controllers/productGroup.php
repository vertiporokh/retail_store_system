<?php

namespace Application\Controllers;

use Application\Models\productGroup as productGroupModel;
use Application\Controllers\View;
use Application\Classes\Answer;
use Application\Classes\E404Exception;
use Application\Classes\Db;
use Application\Controllers\Controller;

class productGroup extends Controller{
	public function actionIndex(){
		return $this->actionGetAll();
	}

	public function actionSave(){
		$productGroup = new productGroupModel();		
		if(isset($_POST['name'])){
			$productGroup->setPostData();
			if(isset($_GET['product_group_id'])){
				$productGroup->id = $_GET['product_group_id'];
			}
			$productGroup->save();
		}
		//если мы просто открыли форму для сохранения товарной группы, будет id, подгружаем данные
		if(isset($_GET['product_group_id'])){
			$productGroup = productGroupModel::getOne(array('id'=>$_GET['product_group_id']));
		}
		$view = new View();
		$view->productGroup = $productGroup;
		$html =  $view->render('saveProductGroup');
		$answer = new Answer($html);
		$answer->productGroups = $productGroup;
		return $answer;
	}


	public function actionDelete(){
		$productGroupe = new productGroupModel();
		if(!isset($_GET['product_group_id']) || (int)$_GET['product_group_id']==0){
			throw new E404Exception('Нужно указать Идентификатор группы');
		}
		$productGroupe->id = $_GET['product_group_id'];
		if(!$productGroupe->delete()){
			throw new Exception('Ошибка удаления Группы товаров');
		}
		$answer = new Answer();
		$answer->statusMessage('товарная группа успешно удалена');
		return $answer;
		
	}

	public function actionGetAll($message = false){
		$productGroups = productGroupModel::get();
		if(!$productGroups){
			throw new E404Exception('Упс, ничего не найдено...');
		}
		$view = new View();
		$view->productGroups = $productGroups;
		$html = $view->render('productGroup');
		$answer = new Answer($html);
		$answer->productGroups = $productGroups;
		return $answer;
	}

	public function actionTest(){

	}



}


?>