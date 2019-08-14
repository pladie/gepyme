<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>GePyME</title>
	<link rel="stylesheet" type="text/css" href="./css/gepyme.css">
</head>
<body class="body">
	<p><br><br><br></p>
	<div align="center">
		<p class="title"><strong>Ingreso al sistema</strong><br><br>
		<form class="form-horizontal" action="index.php" method="post">
			<?php include('errors.php'); ?><br>
			<table class="table">
				<tr><th>Nombre :</th><th><input type="text" name="username" ></th></tr>
				<tr><th>Clave  :</th><th><input type="password" name="password"></th></tr>
				<tr><th colspan="2"><input type="submit" name="login_user" value="Ingresar"></th></tr>
			</table>
		</form>
	</div>
	<p><br>
  		Si no tiene acceso, solicitelo <a href="register.php">AQUI</a>
  	</p>
</body>
</html>