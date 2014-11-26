<?php header('Content-Type: text/html;charset=utf-8;'); ?>
<html>
<head>
	<link href="favicon.png" rel="shortcut icon" type="image/x-icon" />
	<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/myscript.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/registr.js"></script>
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" media="all" href="css/custom.css">
	<link rel="stylesheet" type="text/css" href="css/registr.css">
</head>
<body>
		<div class='cont2'>
			<img src='img/logo_brush.png' style='width:600px'>
		</div>

		<div class='cont well'>
			<form id='regform' class='form-horizontal' action = 'reg.php' method='post' enctype="multipart/form-data">
				<div class='control-group'>
					<input class='input-large' type = 'text' name = 'login' placeholder="Логин" required>
				</div>

				<div class='control-group'>
					<input type = 'password' name = 'password' id='password' placeholder="Пароль" required>
				</div>

				<div class='control-group'>
					<input type = 'password' name = 'pass2' id='password2' placeholder="Повтор пароля" required>
				</div>

				<label class='checkbox'>
					<input type='checkbox' name='private' id='private'>Сделать страницу приватной
				</label>

				<!-- <label class='control-group' for='opt_avatar'>Аватар</label> -->
				<div class='control-group'>
					<button class='btn' type="file" name="avatar" id="avatar"><i class="icon-user"></i>Выбрать аватар</button>
				</div>

				<div class='control-group'>
					<button id='send_reg' class='btn btn-primary' type = 'submit' name = 'registr'>Зарегистрироваться</button>
				</div>
			</form>
			<div id='error_login' class='alert alert-error'>Ощибка</div>
		</div>

</body>
</html>