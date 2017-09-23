<!DOCTYPE html>
<html>
<head>
	<title>Создание/Редактирование склада</title>
</head>
<body>
	<form name="warehouse" action="/warehouse/<?php echo isset($warehouse->id) ? 'update?warehouse_id='.$warehouse->id : 'add'  ?>" method="POST">
		<?php if(isset($warehouse->id)) echo "<input name='id' value='".$warehouse->id."'"; ?>
		<label>Наименование склада</label>
		<input type="text" name="name" value="<?php echo $warehouse->name; ?>"/><br/>
		<label>Описание склада</label>
		<input type="text" name="description" value="<?php echo $warehouse->description; ?>"/><br/>
		<input type="submit"/>
	</form>
</body>
</html>