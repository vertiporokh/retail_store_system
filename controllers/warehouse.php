<?php

namespace Application\Controllers;

use Application\Models\warehouse as warehouseModel;
use Application\Controllers\View;

class warehouse{

	public function actionIndex(){
		$warehouses = array();
		if(isset($_GET['warehouse_id'])){
			$warehouses = warehouseModel::findByColumns(array('id'=>$_GET['warehouse_id']));
		}else{
			$warehouses = warehouseModel::findByColumns();
		}
		$view = new View();
		$view->warehouses = $warehouses;
		return $view->render('warehouseList');
	}
	public function actionAdd(){
		$warehouse = new warehouseModel();
		if(isset($_POST['name'])){
			foreach(warehouseModel::$required_data as $required_data_key => $required_data_value){
				if(isset( $_POST[$required_data_key]))
					$warehouse->$required_data_key = $_POST[$required_data_key]; 
			}
			$warehouse->save();
		}
		$view = new View();
		$view->warehouse = $warehouse;
		return $view->render('saveWarehouse');
	}

	public function actionSave(){

	}
	public function actionDelete(){

	}

}