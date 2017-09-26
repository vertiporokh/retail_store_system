<!DOCTYPE html>
<html>
<head>
	<title>Список Складов</title>
</head>
<body>
	<a href='/product/save'>Создать товар</a><br/>
	<table>
		<trh>
			<tdh>#</tdh>
			<tdh>Наименование</tdh>
			<tdh>Описание</tdh>
			<tdh>Группа товаров</tdh>
			<tdh>Изображение</tdh>
			<tdh>Закупочная цена</tdh>
			<tdh>Крупный опт</tdh>
			<tdh>Средний опт</tdh>
			<tdh>Мелкий опт</tdh>
			<tdh>Розница</tdh>
		</trh>
		<?php if(empty($products)): ?>
			<tr><p>У вас нет товаров</p></tr>
		<?php endif; ?>
		<?php foreach($products as $product): ?>
			<tr>
				<td><?php echo $product->id; ?></td>
				<td><?php echo $product->name; ?></td>
				<td><?php echo $product->description; ?></td>
				<td><?php echo $product->getParent()->name; ?></td>
				<td><?php echo $product->image; ?></td>
				<td><?php echo $product->purchase_price; ?></td>
				<td><?php echo $product->large_opt_price; ?></td>
				<td><?php echo $product->medium_opt_price ? $product->medium_opt_price : 'нет'; ?></td>
				<td><?php echo $product->small_opt_price; ?></td>
				<td><?php echo $product->retail_price; ?></td>
				<td><a href="/product/save?product_id=<?= $product->id ?>">Изменить</a></td>
				<td><a href="/product/delete?product_id=<?= $product->id ?>">Удалить</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
</body>
</html>