<?php
    require '../database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: bmTag.php");
    }
     
    if ( !empty($_POST)) {
        
        // keep track post values
        $id		= $_POST['id'];
        $mod   = $_POST['mod'];
        $serie = $_POST['serie'];
        $asig  = $_POST['asig'];
         
        // validate input
        $valid = true;
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE stock  set stkmodelo = ?, stkserie = ?, stkasignacion = ?, stkestado = ? WHERE stkid = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($mod,$serie,$asig,'ASIGNADO',$id));
            
            $sql = "INSERT INTO log (logtrans,logserie,logitem) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array('CAMBIO',$serie,$stkasignacion . '|' . $stkestado));
            
            Database::disconnect();
            header("Location: bmTag.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM stock where stkid = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data  = $q->fetch(PDO::FETCH_ASSOC);
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
	<h3>Asignacion de Dispositivo</h3>
		<form action="modTag.php" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
			<table class="table" >		
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