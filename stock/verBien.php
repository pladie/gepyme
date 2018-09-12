<?php
    require '../database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: menuStock.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM stock where stkid = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
	<link href="../css/gepyme.css" rel="stylesheet" type="text/css">
</head>
 
<body class="body">
<div align="left" class="volver">
   	<a href="menuStock.php">Volver</a>
	</div>
    <div align="center">
    	<h3>Ver detalle de un Bien</h3>
    	<table class="table">
	    	<tr align="left"><th>Marca:</th><th><?php echo $data['stkmarca'];?></th></tr>
	    	<tr align="left"><th>Modelo:</th><th><?php echo $data['stkmodelo'];?></th></tr>
	    	<tr align="left"><th>Serie:</th><th><?php echo $data['stkserie'];?></th></tr>
	    	<tr align="left"><th>Asignacion:</th><th><?php echo $data['stkasignacion'];?></th></tr>
		</table>
    </div>
  </body>
</html>
