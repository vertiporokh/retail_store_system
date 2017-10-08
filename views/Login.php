<!DOCTYPE html>
<html>
<head>
	<title>Вход в систему</title>
</head>
<body>
	<a href='/user/registration'>Регистрация</a><br/>
	<form name="user_login_form" action='/user/login' method="POST">
		<label>Логин</label>
		<input type="text" name="login" /><br/>
		<label>Пароль</label>
		<input type="text" name="pass" /><br/>
		<input type="button" name="button" value = "Войти" /><a href="/user/forgotpass">Я забыл пароль</a>
	</form>
</body>
</html>