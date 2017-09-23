<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h1><?php echo $error->getMessage(); ?></h1>
<h3>Код ошибки:</h3>
<p>
	<?php var_dump($error); ?>
</p>
</body>
</html>
