<?php
    require '../database.php';
 
    if ( !empty($_POST)) {
        $comp  = null;
        $prov  = null;
        $fec   = null;
		  $imp   = null;      
        $evadm = null;
        $evpro = null;
    	
        $comp  = $_POST['comp'];
        $prov  = $_POST['prov'];
        $fec   = $_POST['fec'];
		  $imp   = $_POST['imp'];        
        $evadm = $_POST['evadm'];
        $evpro = $_POST['evpro'];
        
        $valid = true;
       
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "INSERT INTO facturas (facnro, facfecha, facproveedor, facimporte, facevaladmin, facevalprod) values(?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($comp,$fec,$prov,$imp,$evadm,$evpro));
            
            $trx= date("YmdHMS");
            $text= 'Alta-> ' . $comp . '|' . $prov . '|' . $imp . '|' . $evadm. '|' . $evpro;
            $sql = "INSERT INTO log (logserie,loglong) values(?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($trx,$text));
                     
            Database::disconnect();
            header("Location: bmFac.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
	<link href="../css/gepyme.css" rel="stylesheet" type="text/css">
</head>
 
<body>
	<div align="center">
		<p class="title"><strong>Alta de Factura</strong></p>
		<form class="form-horizontal" action="altaFac.php" method="post">
			<table class="table" >
				<tr align="left"><th>Factura:</th>   <th><input name="comp" type="text" placeholder="Factura"   value="<?php echo !empty($comp)?$comp:'';?>"></th></tr>
            <tr align="left"><th>Fec. Comp.:</th><th><input name="fec"  type="date" placeholder="Fecha"     value="<?php echo !empty($fec)?$fec:'';?>"> </th></tr>
            <?php
					$pdo = Database::connect();
					$sql = "SELECT provnombre FROM proveedores ORDER BY provnombre;";
					echo '<tr align="left"><th>Proveedor:</th><th><select name="prov">';
					foreach ($pdo->query($sql) as $row) {
						echo '<option value="'. $row['provnombre'] . '">'. $row['provnombre'] . '</option>';
					} 
				?>
<!--				<tr align="left"><th>Proveedor:</th> <th><input name="prov" type="text" placeholder="Proveedor" value="<?php echo !empty($prov)?$prov:'';?>"></th></tr> -->
				<tr align="left"><th>Importe:</th>   <th><input name="imp"  type="text" placeholder="Importe"   value="<?php echo !empty($imp)?$imp:'';?>"> </th></tr>
			 	<tr align="left"><th>Ev. Admin.:</th>
			 	<th><select name="evadm">
					<option value="Malo">Malo</option>
				 	<option value="Regular">Regular</option>
				 	<option value="Bueno">Bueno</option>
				 	<option value="Excelente">Excelente</option>
				 	</select>
			 	</th></tr>
			 	<tr align="left"><th>Ev. Prod./Serv.:</th>
			 	<th><select name="evpro">
					<option value="Malo">Malo</option>
					<option value="Regular">Regular</option>
					<option value="Bueno">Bueno</option>
					<option value="Excelente">Excelente</option>
					</select>
				</th></tr>
				<tr><th colspan="2"><input type="submit" value="Dar de alta"></th></tr>       
         </table>
         <br>
         <div class="volver">
         	<a href="menuAdm.php">Volver</a>
         </div>
       </form>
    </div>
  </body>
</html>
