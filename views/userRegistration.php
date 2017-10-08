<!DOCTYPE html>
<html>
<head>
	<title>Регистрация нового пользователя</title>
</head>
<body>
	<a href='/user/login'>Вход в систему</a><br/>
	<form name="user_reg_form" action='/user/registration' method="POST">
		<label>Логин</label>
		<input type="text" name="login" /><br/>
		<label>ФИО</label>
		<input type="text" name="name" /><br/>
		<label>Пароль</label>
		<input type="text" name="pass" /><br/>
		<label>Повтор пароля</label>
		<input type="text" name="repass" /><br/>
		<input type="button" name="button" value = "Зарегистрироваться" />
	</form>
</body>
</html>