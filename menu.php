<?php
	$ver     = `sqlite3 -noheader system.sqlite3 "select valor from system where param='version'  and modulo='system';"`;
	$rev     = `sqlite3 -noheader system.sqlite3 "select valor from system where param='revision' and modulo='system';"`;
	$fix     = `sqlite3 -noheader system.sqlite3 "select valor from system where param='fix'      and modulo='system';"`;
	$adm     = `sqlite3 -noheader system.sqlite3 "select valor from system where param='admin'    and modulo='system';"`;
	$rrhh    = `sqlite3 -noheader system.sqlite3 "select valor from system where param='rrhh'     and modulo='system';"`;
	$stock   = `sqlite3 -noheader system.sqlite3 "select valor from system where param='stock'    and modulo='system';"`;
	$tablero = `sqlite3 -noheader system.sqlite3 "select valor from system where param='tablero'  and modulo='system';"`;
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

<p class="titmod"><strong>Modulos</strong></p>

	<ul>
		<?php if(1==$adm) {
			echo '<li><a target="content" href="./adm/menuAdm.php">Administracion</a></li>';}
			else { echo '<li><a target="content" href="./bienvenido.html" title="Modulo no habilitado">Administracion</a></li>';}
		?>
		<?php if(1==$rrhh){
			echo '<li><a target="content" href="./rrhh/menuRRHH.php">RRHH</a></li>';}
			else {echo '<li><a target="content" href="./bienvenido.html" title="Modulo no habilitado">RRHH</a></li>';}
		?>				
		<?php if(1==$stock){
			echo '<li><a target="content" href="./stock/menuStock.php">Stock</a></li>';}
			else {echo '<li><a target="content" href="./bienvenido.html" title="Modulo no habilitado">Stock</a></li>';}
		?>
		<?php if($tablero==1){
			echo '<li><a target="content" href="./panel/menuPanel.php">Tablero de Control</a></li>';}
			else {echo '<li><a target="content" href="./bienvenido.html" title="Modulo no habilitado">Tablero de Control</a></li>';}
		?>
	</ul>
<br><br><br><br><br><br><br><br><br><br><br><br>
			<hr>
			<p class="menu">Version:  <?php echo $ver.'. '.$rev.'. '.$fix ?>
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
	<p class="footer">&copy;Tatu S.I. 2016-2018
</div>
</body>
</html>
