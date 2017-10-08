<!DOCTYPE html>
<html>
<head>
	<title>Товар</title>
</head>
<body>
	<form name="product" action="/product/save<?php echo isset($product->id) ? '/'.$product->id : ''  ?>" method="POST">
		<h1><?php echo isset($product->id) ? 'Редактирование товара' : 'Создание товара'  ?></h1>
		<label>Имя</label>
		<input type="text" name="name" value="<?php echo $product->name; ?>"/><br/>
		<label>Описание товара</label>
		<input type="text" name="description" value="<?php echo $product->description; ?>"/><br/>
		<label>Родительская группа</label>
		<select name="parent_id">
			<?php foreach($productGroups as $productGroup): ?>
				<option <?php if($product->parent_id == $productGroup->id) echo 'selected' ?> value="<?php echo $productGroup->id?>"><?php echo $productGroup->name?></option>
			<?php endforeach; ?>
		</select><br/>
		<label>Изображение</label>
		<input type="text" name="image" value="<?php echo $product->image; ?>"/><br/>
		<label>Закупочная цена</label>
		<input type="text" name="purchase_price" value="<?php echo $product->purchase_price; ?>"/><br/>
		<label>Крупный опт</label>
		<input type="text" name="large_opt_price" value="<?php echo $product->large_opt_price; ?>"/><br/>
		<label>Средний опт</label>
		<input type="text" name="medium_opt_price" value="<?php echo $product->medium_opt_price; ?>"/><br/>
		<label>Мелкий опт</label>
		<input type="text" name="small_opt_price" value="<?php echo $product->small_opt_price; ?>"/><br/>
		<label>Розница</label>
		<input type="text" name="retail_price" value="<?php echo $product->retail_price; ?>"/><br/>
		<input type="submit" value = "Сохранить"/>
	</form>
</body>
</html>