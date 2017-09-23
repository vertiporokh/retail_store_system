<!DOCTYPE html>
<html>
<head>
	<title>Группа Товаров</title>
</head>
<body>
	<form name="productGroup" action="/productGroup/<?php echo isset($productGroup->id) ? '?product_groupe_id='.$productGroup->id : ''  ?>" method="POST">
		<?php if(isset($productGroup->id)) echo "<input name='id' value='".$productGroup->id."'"; ?>
		<label>Имя группы</label>
		<input type="text" name="name" value="<?php echo $productGroup->name; ?>"/><br/>
		<label>Описание группы</label>
		<input type="text" name="description" value="<?php echo $productGroup->description; ?>"/><br/>
		<label>Родительская группа</label>
		<input type="text" name="parent_id" value="<?php echo $productGroup->parent_id; ?>"/><br/>
		<input type="submit"/>
	</form>
</body>
</html>