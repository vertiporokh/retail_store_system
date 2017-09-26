<?php
namespace Application\Controllers;

use Application\Models\product as productModel;
use Application\Models\productGroup as productGroupModel;
use Application\Controllers\View;
use Application\Classes\Answer;
use Application\Classes\E404Exception;
use Application\Classes\Db;
use Application\Controllers\Controller;

class product extends Controller{
	public function actionSave(){
		$product = new productModel();		
		if(isset($_POST['name'])){
			$product->setPostData();
			if(isset($_GET['product_id'])){
				$product->id = $_GET['product_id'];
			}
			$product->save();
		}
		//если мы просто открыли форму для сохранения товарной группы, будет id, подгружаем данные
		if(isset($_GET['product_id'])){
			$product = productModel::getOne(array('id'=>$_GET['product_id']));
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
		$producte = new productModel();
		if(!isset($_GET['product_id']) || (int)$_GET['product_id']==0){
			throw new Exception('Нужно указать Идентификатор товара');
		}
		$producte->id = $_GET['product_id'];
		if(!$producte->delete()){
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