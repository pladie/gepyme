<?php
	include "langsettings.php";
	$today = date("YmdHMS");
	$ver = `sqlite3 -noheader system.sqlite3 "select valor from system where param='version'  and modulo='system';"`;
	$rev = `sqlite3 -noheader system.sqlite3 "select valor from system where param='revision' and modulo='system';"`;
	$fix = `sqlite3 -noheader system.sqlite3 "select valor from system where param='fix'      and modulo='system';"`;
?>
<!DOCTYPE HTML>
<html>
<head>
	<link href="./css/gepyme.css" rel="stylesheet" type="text/css">
	<title></title>
</head>

<body class="body" bgcolor="gray">
	<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				<hr>
				<p class="menu">GePyME<br><br>Sistema integral<br>para PyMES<br>
				<hr>
			</td>
		</tr>
		<tr>
			<td colspan="1" bgcolor="#FFFFFF"></td>
		</tr>
		<tr>
			<td>
				<p class="titmod"><strong>Modulos</strong></p>
				<p class="modulos">
				<a target="content" href="./rrhh/menuRRHH.php" title="v1.0.0">RRHH</a><br>
				<a target="content" href="./stock/menuStock.php" title="v1.0.0">Stock</a><br>
			</td>
		</tr>
		<td>
			<br><br><br><br><br><br><br><br><br><br><br><br>
			<hr>
			<p class="menu">Version:  <?php echo $ver.'. '.$rev.'. '.$fix ?>
		</td>
		<tr>
			<td>
				<hr>
				<a target=content href="http://www.debian.org/"> <img src="./img/debian.png"   width="47" height="17" alt=""></a>
				<a target=content href="http://www.mariadb.org/"><img src="./img/mariadb.png"  width="47" height="12" alt=""></a>
				<a target=content href="http://www.php.org/en/"> <img src="./img/php.png"      width="47" height="25" alt=""></a>
				<a target=content href="http://www.w3c.org">     <img src="./img/html5.png"    width="30" height="25" alt=""></a>
				<a target=content href="http://www.w3c.org">     <img src="./img/js.png"       width="30" height="25" alt=""></a>
				<a target=content href="http://www.w3c.org">     <img src="./img/css3.png"     width="30" height="25" alt=""></a>
				<a target=content href="http://www.w3c.org">     <img src="./img/fpdfLogo.png" width="47" height="25" alt=""></a>
				<p class="footer">&copy; Tatu S.I. 2016-2018
			</td>
		</tr>
	</table>
</body>
</html>
