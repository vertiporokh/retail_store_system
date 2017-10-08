<!DOCTYPE html>
<html>
<head>
	<title>Создание/Редактирование склада</title>
</head>
<body>
	<form name="warehouse" action="/warehouse/save<?php echo isset($warehouse->id) ? '/'.$warehouse->id : '' ?>" method="POST">
		<h1><?php echo isset($warehouse->id) ? 'Редактирование склада' : 'Создание склада'  ?></h1>
		<label>Наименование склада</label>
		<input type="text" name="name" value="<?php echo $warehouse->name; ?>"/><br/>
		<label>Описание склада</label>
		<input type="text" name="description" value="<?php echo $warehouse->description; ?>"/><br/>
		<input type="submit"/>
	</form>
</body>
</html>