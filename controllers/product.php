<?php
namespace Application\Controllers;

use Application\Models\product as productModel;
use Application\Models\productGroup as productGroupModel;
use Application\Controllers\View;
use Application\Classes\Answer;
use Application\Classes\E404Exception;
use Application\Classes\Exception;
use Application\Classes\Db;
use Application\Controllers\Controller;

class product extends Controller{
	public function actionSave(){
		$product = new productModel($this->id);		
		if(isset($_POST['name'])){
			$product->setPostData();
			$product->id = $this->id;
			$product->save();
		}
		$view = new View();
		$view->product = $product;
		$view->productGroups = productGroupModel::get();
		$html =  $view->render('saveproduct');
		$answer = new Answer($html);
		$answer->products = $product;
		return $answer;
	}


	public function actionDelete(){
		$product = new productModel();
		if(!$this->id){
			throw new E404Exception('Нужно указать Идентификатор товара');
		}
		$product->id = $this->id;
		if(!$product->delete()){
			throw new Exception('Ошибка удаления Группы товаров');
		}
		$answer = new Answer();
		$answer->statusMessage('товар успешно удален');
		return $answer;
		
	}

	public function actionGetAll($message = false){
		$products = productModel::get();
		$view = new View();
		$view->products = $products;
		$html = $view->render('productList');
		$answer = new Answer($html);
		$answer->products = $products;
		return $answer;
	}
}


?>