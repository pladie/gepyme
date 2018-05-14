<?php
    require '../database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: bmSer.php");
    }
     
    if ( !empty($_POST)) {
        
        // keep track post values
        $id		= $_POST['id'];
        $marca = $_POST['marca'];
        $mod   = $_POST['mod'];
        $serie = $_POST['serie'];
        $asig  = $_POST['asig'];
         
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
            $sql = "UPDATE stock  set stkmarca = ?, stkmodelo = ?, stkserie = ?, stkasignacion = ? WHERE stkid = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($marca,$mod,$serie,$asig,$id));
            Database::disconnect();
            header("Location: bmSer.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM stock where stkid = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data  = $q->fetch(PDO::FETCH_ASSOC);
        $marca = $data['stkmarca'];
        $mod   = $data['stkmodelo'];
        $serie = $data['stkserie'];
        $asig  = $data['stkasignacion'];
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
	<h3>Asignacion de Servidor</h3>
		<form action="modSer.php" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
			<table class="table" >		
				<tr align="left"><th>Marca:</th> <th><input type="text" id="marca" name="marca" tabindex="1" value="<?php echo $marca; ?>"></th></tr>
				<tr align="left"><th>Modelo:</th><th><input type="text" id="mod"   name="mod"   tabindex="2" value="<?php echo $mod; ?>"></th></tr>
				<tr align="left"><th>Serie:</th> <th><input type="text" id="serie" name="serie" tabindex="3" value="<?php echo $serie; ?>"></th></tr>
            <?php
					$pdo = Database::connect();
					$sql = "SELECT pernombre FROM personas WHERE perestado = 'Empleado' ORDER BY pernombre;";
					echo '<tr align="left"><th>Asignacion:</th><th><select name="asig">';
					foreach ($pdo->query($sql) as $row) {
						echo '<option value="'. $row['pernombre'] . '">'. $row['pernombre'] . '</option>';
					} 
				?>
				<tr><th colspan="2"><input type="submit" value="Actualizar" ></th></tr>
			</table>
		</form>
	</div>
       
  </body>
</html>
