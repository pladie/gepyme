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
		<p class="title"><strong>Solicitud de Ingreso al sistema</strong></p><br><br>
		<form class="form-horizontal" method="post" action="register.php">
			<?php include('errors.php'); ?>
			<table class="table">
				<tr><th>Nombre :</th><th><input type="text"     name="username"></th></tr>
				<tr><th>Email  :</th><th><input type="email"    name="email"></th></tr>
				<tr><th>Clave  :</th><th><input type="password" name="password"></th></tr>
				<tr><th>Reingrese Clave  :</th><th><input type="password" name="password_2"></th></tr>
				<tr><th colspan="2"><input type="submit" name="reg_user" value="Enviar solicitud"></th></tr>
			</table>
		</form>
	</div>
	<p><br>
  		Ya tiene usuario? <a href="index.php">Ingreso</a>
  	</p>
</body>




				








</html>