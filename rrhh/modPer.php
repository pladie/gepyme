<?php
    require '../database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: bmPer.php");
    }
     
    if ( !empty($_POST)) {
        
        // keep track post values
        $id		  = $_POST['id'];
        $nombre  = $_POST['nombre'];
        $dni     = $_POST['dni'];
        $estado  = $_POST['estado'];
        $fecalta = $_POST['fecalta'];
         
        // validate input
        $valid = true;
//        if (empty($name)) {
//            $nameError = 'Please enter Name';
//            $valid = false;
//        }
//        if (empty($dni)) {
//            $dniError = 'Please enter DNI';
//            $valid = false;
//        }
//        if (empty($estado)) {
//            $estadoError = 'Please enter Estado';
//            $valid = false;
//        }
//        if (empty($fecalta)) {
//            $fecaltaError = 'Please enter Fecha de Alta';
//            $valid = false;
//        }
//        if (empty($fecbaja)) {
//            $fecbajaError = 'Please enter Fecha de Baja';
//            $valid = false;
//        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE personas  set pernombre = ?, perdni = ?, perestado = ?, perfecalta = ? WHERE perid = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($nombre,$dni,$estado,$fecalta,$id));
            Database::disconnect();
            header("Location: bmPer.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM personas where perid = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data    = $q->fetch(PDO::FETCH_ASSOC);
        $nombre  = $data['pernombre'];
        $dni     = $data['perdni'];
        $estado  = $data['perestado'];
        $fecalta = $data['perfecalta'];
        $fecbaja = $data['perfecbaja'];
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
		<form action="modPer.php" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
			<table class="table" >
				<thead><tr><th colspan="2">Actualizacion de datos de la Persona</th></tr></thead>		
				<tr><th>Nombre:</th><th><input type="text" id="nombre"  name="nombre" tabindex="1" value="<?php echo !empty($nombre)?$nombre:''; ?>"></th></tr>
				<tr><th>DNI:</th>   <th><input type="text" id="dni"     name="dni"    tabindex="2" value="<?php echo !empty($dni)?$dni:''; ?>"></th></tr>
				<tr><th>Estado:</th><th><input type="text" id="estado"  name="estado" tabindex="3" value="<?php echo !empty($estado)?$estado:''; ?>"></th></tr>
				<tr><th>Alta:</th>  <th><input type="date" id="fecalta" name="fecalta"tabindex="4" value="<?php echo !empty($fecalta)?$fecalta:''; ?>"></th></tr>
				<tr><th colspan="2"><input type="submit" value="Actualizar" ></th></tr>
			</table>
		</form>
	</div>
       
  </body>
</html>
