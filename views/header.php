<header class="header">
	<div class="wrapper headTop">
		<div class="logo">
			<a href="#"><span>BRAN</span><span class="headSp">D</span></a>
		</div>

		<?php if ($authorization) : ?>
			<form class="formHead" action="/auth/login" method="post">
				<p>Здравствуйте <?= $name ?>! Добро пожаловать в интернет-магазин!
					<span>/</span><a href="/auth/logout/" id="logout">Выйти</a>/
				</p>
			</form>

		<?php else : ?>
			<form class="formHead" action="/auth/login" method="post">
				<p>Пожалуйста, авторизуйтесь или зарегистрируйтесь!</p>
				<input id="login" type="text" name="login" placeholder="Логин">
				<input id="password" type="password" name="pass" placeholder="Пароль">
				<input id="send" type="submit" name="send" value="Войти">
			</form>

		<?php endif; ?>
		<div class="headCart"></div>
		<button class="headBtn">
			<span>My Account</span>
			<i class="fas fa-caret-down"></i>
		</button>
	</div>
</header>