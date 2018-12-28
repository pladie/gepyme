<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE HTML>
<head>
<head>
<meta http-equiv="cache-control" content="no-cache">
<title>GePyMES</title>
<frameset rows="74,*" marginwidth="0" marginheight="0" frameborder="0" border="0" borderwidth="0">
   <frame name="head" src="head.php" scrolling=no>
	<frameset cols="150,*" marginwidth="0" marginheight="0" frameborder="0" border="0" borderwidth="0">
   	<frame name="navi" src="menu.php" scrolling=no>
   	<frame name="content" src="bienvenido.html" marginwidth=20>
	</frameset>
</frameset>
</head>
<body bgcolor="lightgray"></body></html>