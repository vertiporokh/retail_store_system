<?php

namespace Application\Controllers;

use Application\Models\productGroup as productGroupModel;
use Application\Controllers\View;
use Application\Classes\Answer;
use Application\Classes\E404Exception;
use Application\Classes\Db;

class productGroup{

	public function actionIndex(){

		$db = new Db();

		if(isset($_GET['product_group_id'])){
			$productGroups = productGroupModel::findByColumns(array('id'=>$_GET['product_group_id']));
		}else{
			$productGroups = productGroupModel::findByColumns();
		}
		if(empty($productGroups)){
			throw new E404Exception('Упс, ничего не найдено...');
		}
		$view = new View();
		$view->productGroups = $productGroups;
		$html = $view->render('productGroup');
		$answer = new Answer($html);
		$answer->productGroups = $productGroups;
		return $answer;
	}

	public function actionSave(){
		$productGroup = new productGroupModel();
		if(isset($_POST['name'])){
			foreach(productGroupModel::$required_data as $required_data_key => $required_data_value){
				if(isset( $_POST[$required_data_key]))
					$productGroup->$required_data_key = $_POST[$required_data_key]; 
			}
			if(isset($_GET['product_group_id'])){
				$productGroup->id = $_GET['product_group_id'];
			}
			$productGroup->save();
		}else{
			if(isset($_GET['product_group_id'])){
				$productGroup = productGroupModel::findOneByPK($_GET['product_group_id']);
			}
		}
		$view = new View();
		$view->productGroup = $productGroup;
		return $view->render('saveProductGroup');
	}


	public function actionDelete(){
		$productGroupe = new productGroupModel();
		$productGroupe->id = $_GET['product_group_id'];
		if(!$productGroupe->delete()){
			throw new Exception('Ошибка удаления Группы товаров');
		}
		echo "товарная группа успешно удалена";
		
	}



}


?>