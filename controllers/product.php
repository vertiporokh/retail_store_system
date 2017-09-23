<?php
namespace Application\Controllers;

use Application\Models\productGroup as productGroupModel;
use Application\Controllers\View;
class product{
	public function actionShowGroup(){
		$productGroup = new productGroupModel();
		if(isset($_GET['group_id']) && $_GET['group_id']>0){
			$productGroup = productGroupModel::findOneByPk($_GET['group_id']);
		}
		$view = new View();
		$view->productGroup = $productGroup;
		return $view->render('productGroup');
	}

	public function actionSaveGroup(){
		$productGroup = new productGroupModel();
		productGroupModel::validate($_POST);
		foreach(productGroupModel::$required_data as $required_data_key => $required_data_value){
			if(isset( $_POST[$required_data_key]))
				$productGroup->$required_data_key = $_POST[$required_data_key]; 
		}
		if(isset($_POST['id'])){
			$productGroup->id = $_POST['id'];
		}
		$productGroup->save();
	}

	public function actionDeleteGroup(){

	}


}


?>