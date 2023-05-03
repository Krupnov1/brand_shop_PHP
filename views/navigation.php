<nav class="navigation">

	<?php foreach ($menu as $value) : ?>

		<a href="<?= $value['route'] ?>"> <?= $value['name'] ?> </a>

	<?php endforeach; ?>
	<a href="/basket/all">Корзина (<span id="count"><?= $count ?></span>) </a> 

	<?if ($isAdmin == 'admin'):?>

	<a href="/admin/management">Страница админа</a>  
	
	<?endif; ?>

</nav>
	
