<!--<?php/*
// Inicializo la sesion.
session_start();
 
// Si pudo loguearse, ingresa al sistema
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
    session_unset();     // limpio los datos de la sesion
    session_destroy();   // borra los datos almacenados de la session.
    exit;
}
$_SESSION['LAST_ACTIVITY'] = time(); // Actualizo la ultima actividad
*/
?>-->
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