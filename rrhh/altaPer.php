<?php
    require '../database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nombre = null;
        $dni    = null;
        $estado = null;
        $fecha  = null;
         
        // keep track post values
        $nombre = $_POST['nombre'];
        $dni    = $_POST['dni'];
		  $estado = $_POST['estado'];
        $fecha  = $_POST['fecha'];
         
        // validate input
        $valid = true;
        if (empty($nombre)) {
            $nombre = 'Please enter Name';
            $valid = false;
        }
        
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "INSERT INTO personas (pernombre,perdni,perestado,perfecalta) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nombre,$dni,$estado,$fecha));
            
            Database::disconnect();
            header("Location: bmPer.php");
        }
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
        <p class="title"><strong>Alta de Persona</strong>
        <form class="form-horizontal" action="altaPer.php" method="post">
        		<table class="table">
						<tr><th>Nombre :</th><th><input name="nombre" type="text" placeholder="Nombre" value="<?php echo !empty($nombre)?$nombre:'';?>"></th></tr>             
             		<tr><th>DNI :</th>   <th><input name="dni"    type="text" placeholder="DNI"    value="<?php echo !empty($dni)?$dni:'';?>">      </th></tr>
		            <tr><th>Estado :</th><th><input name="estado" type="text" placeholder="Estado" value="<?php echo !empty($estado)?$estado:'';?>"></th></tr>
		            <tr><th>Fecha :</th><th><input  name="fecha"  type="date" placeholder="fecha"  value="<?php echo !empty($fecha)?$fecha:'';?>"></th></tr>
		            <tr><th colspan="2"><input type="submit" value="Dar de alta"></th></tr>
            </table>
            <br>
            <a href="menuRRHH.php">Volver</a>
        </form>
     </div>
  </body>
</html>
