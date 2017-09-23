<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php foreach($mainController->getStyles() as $style): ?>
		<style type="text/css" src="<?php echo $style; ?>"></style>
	<?php endforeach; ?>
	<?php foreach($mainController->getScripts() as $script): ?>
		<script type="text/javascript" src="<?php echo $script; ?>"></script>
	<?php endforeach; ?>
</head>
<body>
	<header>
		Шапка
	</header>
	<div class="container">
		<?php echo $mainController->content->getHtml(); ?>
	</div>
	<footer>
		Футер
	</footer>
</body>
</html>