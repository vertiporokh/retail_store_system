<?php
namespace Application\Controllers;

use Application\Models\User as UserModel;
use Application\Classes\Answer;
use Application\Classes\ValidationException;
use Application\Controllers\View;


class User extends \Application\Controllers\controller{
	public function actionIndex(){
		return $this->actionGetAll();
	}

	public function actionSave(){
		$user = new userModel($this->id);		
		//если есть post-данные, то сохраняем или создаем нового юзера.
		if(isset($_POST['name'])){
			$user->setPostData();
			$user->save();
		}

		$view = new View();
		$view->user = $user;
		$html =  $view->render('saveuser');
		$answer = new Answer($html);
		return $answer;
	}


	public function actionDelete(){
		$user = new userModel();
		if(!$this->id){
			throw new Exception('Нужно указать Идентификатор пользователя');
		}
		$user->id = $this->id;
		if(!$user->delete()){
			throw new Exception('Ошибка удаления Пользователя');
		}
		$answer = new Answer();
		$answer->statusMessage('Пользователь успешно удален');
		return $answer;
		
	}

	public function actionGetAll(){
		$users = userModel::get();
		$view = new View();
		$view->users = $users;
		$html = $view->render('userList');
		$answer = new Answer($html);
		$answer->users = $users;
		return $answer;
	}

	protected function generateHash($count){
		$chars = 'qwertyuiopasdfghjklzxcvbnm1234567890MNBVCXZLKJHGFDSAPOIUYTREWQ';
		$len = strlen($chars)-1;
		$hash = '';
		while($count--){
			$hash .= $chars[rand(0,$len)];
		}
		return $hash;
	}

	public function actionRegistration(){
		$view = new View();
		$html = $view->render('userRegistration');
		$answer = new Answer($html);
		if(isset($_POST['login'])){
			//добавить нормальную валидацию, когда появится класс
			$user = userModel::get(array('login'=>$_POST['login']));
			if($user){
				throw new ValidationException('Пользователь с таким Email уже зарегистрирован', 'login');
			}
			if($_POST['pass'] != $_POST['repass']){
				throw new ValidationException('Пароли не совпадают. Проверьте правильность', 'repass');	
			}
			$user = new userModel();
			$user->setPostData();
			//генерируем hash
			$user->hash = $this->generateHash(20);
			$user_id = $user->save();
			if(!$user_id){
				throw new ValidationException('Что-то пошло не так. Попробуйте еще раз через некоторое время');	
			}
			//отправляем email для подтверждения. Когда появится соответсующий класс
			//mail($_POST['login'], 'Регистрация в системе складского учета', $this->mainController->host.'/user/confirm?user_id='.$user->id.'&hash='.$user->hash);
		}
		return new Answer($html);
	}
	
	public function actionLogin(){
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']>0){
			header('Location: /product');
		}
		$view = new View();
		$html = $view->render('Login');
		if(isset($_POST['login']) && isset($_POST['pass'])){
			//добавить нормальную валидацию, когда появится класс
			$user = userModel::get(array('login' => $_POST['login'], 'pass' => md5(md5($_POST['pass']))));
			if($user){
				if(!$user->confirm){

					throw new ValidationException('Подтвердите адрес электронной почты');
				}
				$_SESSION['user_id'] = $user->id;
				header('Location: /product');		
			}else{
				throw new ValidationException('Неверная пара Логин/Пароль', 'login');
			}
		}
		return new Answer($html);

	}


}





?>