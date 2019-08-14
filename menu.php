<?php
	require './database.php';

	$ver     = `sqlite3 -noheader system.sqlite3 "select valor from system where param='version'  and modulo='system';"`;
	$rev     = `sqlite3 -noheader system.sqlite3 "select valor from system where param='revision' and modulo='system';"`;
	$fix     = `sqlite3 -noheader system.sqlite3 "select valor from system where param='fix'      and modulo='system';"`;
	$adm     = `sqlite3 -noheader system.sqlite3 "select valor from system where param='admin'    and modulo='system';"`;
	$rrhh    = `sqlite3 -noheader system.sqlite3 "select valor from system where param='rrhh'     and modulo='system';"`;
	$stock   = `sqlite3 -noheader system.sqlite3 "select valor from system where param='stock'    and modulo='system';"`;
	$tablero = `sqlite3 -noheader system.sqlite3 "select valor from system where param='tablero'  and modulo='system';"`;

	session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

	// Busco al usuario y sus privilegios para mostrar menu

	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "SELECT * FROM users where usunombre = ?";

	$q = $pdo->prepare($sql);
	$q->execute(array($_SESSION['username']));
	$data  = $q->fetch(PDO::FETCH_ASSOC);
	$usuValido = $data['usuestado'];
	$privadm = $data['privA'];
	$privrrhh = $data['privR'];
	$privstock = $data['privS'];
	$privpanel = $data['privP'];

	Database::disconnect();

?>
<!DOCTYPE html>
<html>
<head>
	<link href="./css/gepyme.css" rel="stylesheet" type="text/css">
</head>
<body class="body">

<hr>
	<p class="title"><strong>GePyME</strong></p>Sistema integral<br>para PyMES
<hr>

<br><p class="titmod"><strong>Modulos</strong></p><br>

	<ul>
		<?php if(1 == $adm && $privadm >= 0) {
			if($privadm == 0)
				 echo '<li><a target="content" href="./adm/repAdm.php" title="Reportes">ADM & FIN</a></li>';
			else echo '<li><a target="content" href="./adm/menuAdm.php">ADM & FIN</a></li>';
			}
		?>
		<?php if(1==$rrhh && $privrrhh >= 0){
			if($privrrhh == 0)
				 echo '<li><a target="content" href="./adm/repRRHH.php" title="Reportes">Recursos Humanos</a></li>';
			else echo '<li><a target="content" href="./rrhh/menuRRHH.php">RRHH</a></li>';
			}
		?>				
		<?php if(1==$stock && $privstock >= 0){
			if($privstock == 0)
				 echo '<li><a target="content" href="./adm/repStock.php" title="Reportes">Stock</a></li>';
			else echo '<li><a target="content" href="./stock/menuStock.php">Stock</a></li>';
			}
		?>
		<?php if($tablero==1 && $privpanel >= 0){
			if($privpanel == 0)
				 echo '<li><a target="content" href="./adm/repPanel.php" title="Reportes">Panel de control</a></li>';
			else echo '<li><a target="content" href="./panel/menuPanel.php">Tablero de Control</a></li>';
			}
		?>
	</ul>
<br><br><br><br><br><br><br><br><br><br><br><br>
			<hr>
			Version:  <?php echo $ver.'. '.$rev.'. '.$fix ?>
			<hr>
<div align="center">
	<a href="http://www.debian.org/"> <img src="./img/debian.png"   width="47" height="17" alt=""></a>
	<a href="http://www.mariadb.org/"><img src="./img/mariadb.png"  width="47" height="12" alt=""></a>
	<a href="http://www.w3c.org">     <img src="./img/html5.png"    width="30" height="25" alt=""></a>
	<a href="http://www.w3c.org">     <img src="./img/js.png"       width="30" height="25" alt=""></a>
	<a href="http://www.w3c.org">     <img src="./img/css3.png"     width="30" height="25" alt=""></a>
	<a href="http://www.fpdf.org">    <img src="./img/fpdfLogo.png" width="47" height="25" alt=""></a>
	<a href="http://www.php.org/en/"> <img src="./img/php.png"      width="47" height="25" alt=""></a>
	<a href="http://www.fpdf.org">    <img src="./img/sqlite370_banner.gif" width="55" height="25" alt=""></a>
	<a href="https://jpgraph.net">    <img src="./img/jpgraph_logo.png" width="65" height="25" alt=""></a>
	<p class="footer">&copy;Tatu S.I. 2016-2019
</div>
</body>
</html>
