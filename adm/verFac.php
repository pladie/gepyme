<?php
    require '../database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: menuAdm.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM facturas where facid = ?";
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
    <div align="center">
	   <p class="title"><strong>Ver datos Factura</strong></p>
	 	<table class="table" >
	 		<tr align="left"><th>Factura:</th><th><?php echo $data['facnro'];?></th></tr>
	 		<tr align="left"><th>Fecha:</th><th><?php echo $data['facfecha'];?></th></tr>
	 		<tr align="left"><th>Proveedor:</th><th><?php echo $data['facproveedor'];?></th></tr>
	 		<tr align="left"><th>Importe:</th><th><?php echo $data['facimporte'];?></th></tr>
	 		<tr align="left"><th>Ev. Admm.:</th><th><?php echo $data['facevaladmin'];?></th></tr>
	 		<tr align="left"><th>Ev. Prod./Serv.:</th><th><?php echo $data['facevalprod'];?></th></tr>
	 	</table>
	 	<br>
	 	<div class="volver">
	 		<a href="bmFac.php">Volver</a>
	 	</div>
	 </div>
</body>
</html>
