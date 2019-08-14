<?php 
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
?>
<!DOCTYPE HTML>
<head>
<head>
<meta http-equiv="cache-control" content="no-cache">
<title>GePyME</title>
<frameset rows="74,*" marginwidth="0" marginheight="0" frameborder="0" border="0" borderwidth="0">
   <frame name="head" src="head.php" scrolling=no>
	<frameset cols="150,*" marginwidth="0" marginheight="0" frameborder="0" border="0" borderwidth="0">
   	<frame name="navi" src="menu.php" scrolling=no>
   	<frame name="content" src="bienvenido.html" marginwidth=20>
	</frameset>
</frameset>
</head>
<body bgcolor="lightgray"></body></html>
