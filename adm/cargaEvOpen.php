<?php
    require '../database.php';
 
    if ( !empty($_POST)) {
        $prov  = null;
        $fec   = null;
        $evpro = null;
    	
        $prov  = $_POST['prov'];
        $fec   = $_POST['fec'];
        $evpro = $_POST['evpro'];
        
        $valid = true;
       
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "INSERT INTO facturas (facnro, facfecha, facproveedor, facimporte, facevaladmin, facevalprod) values(?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array('0',$fec,$prov,'0','0',$evpro));
            
            $trx= date("YmdHMS");
            $text= 'Alta-> ' . '0' . '|' . $prov . '|' . '0' . '|' . '0' . '|' . $evpro;
            $sql = "INSERT INTO log (logserie,loglong) values(?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($trx,$text));
                     
            Database::disconnect();
            header("Location: menuAdm.php");
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
	<div align="left" class="volver">
   	<a href="menuAdm.php">Volver</a>
	</div>
	<div align="center">
		<p class="title"><strong>Evaluacion de Proveedores Sin Factura</strong></p>
		<form class="form-horizontal" action="altaFac.php" method="post">
			<table class="tableli" >
				<tr align="left"><th>Fec. Comp.:</th><th><input name="fec" type="date" placeholder="Fecha" value="<?php echo !empty($fec)?$fec:'';?>"> </th></tr>
            <?php
					$pdo = Database::connect();
					$sql = "SELECT provnombre FROM proveedores WHERE provestado != 'BAJA' AND protipo = 1 ORDER BY provnombre;";
					echo '<tr align="left"><th>Proveedor:</th><th><select name="prov">';
					foreach ($pdo->query($sql) as $row) {
						echo '<option value="'. $row['provnombre'] . '">'. $row['provnombre'] . '</option>';
					}
					Database::disconnect(); 
				?>
			 	<tr align="left"><th>Ev. Prod./Serv.:</th>
			 	<th><select name="evpro">
			 		<option value="N/A">N/A</option>
					<option value="Malo">Malo</option>
					<option value="Regular">Regular</option>
					<option value="Bueno">Bueno</option>
					<option value="Excelente">Excelente</option>
					</select>
				</th></tr>
				<tr align="center"><th colspan="2"><input type="submit" value="Dar de alta"></th></tr>       
         </table>
       </form>
    </div>
  </body>
</html>
