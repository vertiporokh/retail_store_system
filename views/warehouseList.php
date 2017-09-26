<!DOCTYPE html>
<html>
<head>
	<title>Список Складов</title>
</head>
<body>
	<a href='/warehouse/save'>Создать склад</a>
	<table>
		<?php if(empty($warehouses)): ?>
			<tr><p>У вас нет складов</p></tr>
		<?php endif; ?>
		<?php foreach($warehouses as $warehouse): ?>
			<tr>
				<td><?php echo $warehouse->id; ?></td>
				<td><?php echo $warehouse->name; ?></td>
				<td><?php echo $warehouse->description; ?></td>
				<td><a href="/warehouse/save?warehouse_id=<?= $warehouse->id ?>">Изменить</a></td>
				<td><a href="/warehouse/delete?warehouse_id=<?= $warehouse->id ?>">Удалить</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
</body>
</html>