<!DOCTYPE html>
<html>
<head>
	<title>Группа Товаров</title>
</head>
<body>
	<table>
		<?php foreach($productGroups as $productGroup): ?>
			<tr>
				<td><?php echo $productGroup->id; ?></td>
				<td><?php echo $productGroup->name; ?></td>
				<td><?php echo $productGroup->description; ?></td>
				<td><?php echo $productGroup->parent_id; ?></td>
				<td><a href="/productGroup/save?product_group_id=<?= $productGroup->id ?>">Изменить</a></td>
				<td><a href="/productGroup/delete?product_group_id=<?= $productGroup->id ?>">Удалить</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
</body>
</html>