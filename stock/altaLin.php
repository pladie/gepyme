<?php
    require '../database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $marca = null;
        $mod   = null;
        $serie = null;
        $plan  = null;
        $nro   = null;
        $proy  = null;
         
        // keep track post values
        $marca = $_POST['marca'];
        $mod   = $_POST['mod'];
        $serie = $_POST['serie'];
        $plan  = $_POST['plan'];
        $nro   = $_POST['numero'];
        $proy  = $_POST['proy'];
         
        // validate input
        $valid = true;
        if (empty($marca)) {
            $marca = 'Please enter Name';
            $valid = false;
        }
        
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "INSERT INTO stock (stkmarca,stkmodelo,stkserie,stkasignacion,stkestado,stktipo,stkplan,stknumero,stkproyecto) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($marca,$mod,$serie,'STOCK','ASIGNADO','Linea',$plan,$nro,$proy));
            
            $sql = "INSERT INTO log (logtrans,logserie,logitem) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array('ALTA->STOCK',$serie,'STOCK'));
                     
            Database::disconnect();
            header("Location: bmLin.php");
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
   	<a href="menuStock.php">Volver</a>
</div>
<div align="center">
   	<h3>Alta de Linea</h3>
      	<form class="form-horizontal" action="altaLin.php" method="post">
        		<table class="table" >
        			<tr align="left"><th>Marca :</th>
						<th><select name="marca">
							<option value="Claro-ATX">Claro-ATX</option>
							<option value="Movistar-Lugalu">Movistar-Lugalu</option>
							<option value="Personal-Lugalu">Personal-Lugalu</option>
							<option value="Nextel">Nextel</option>
							</select>
						</th></tr>             
             	<tr align="left"><th>Modelo :</th><th><input name="mod"   type="text" placeholder="Modelo" value="<?php echo !empty($mod)?$mod:'';?>">    </th></tr>
		        <tr align="left"><th>Numero :</th><th><input name="nro"   type="text" placeholder="Numero" value="<?php echo !empty($nro)?$nro:'';?>"></th></tr>
                <tr align="left"><th>Serie  :</th><th><input name="serie" type="text" placeholder="Serie"  value="<?php echo !empty($serie)?$serie:'';?>"></th></tr>
					<tr align="left"><th>Plan :</th>
						<th><select name="plan">
							<option value="BAM06">BEM06</option>
							<option value="BAM21">BEM21</option>
                            <option value="BAM21">BEM32</option>
                            <option value="BAM21">BEM33</option>
							<option value="PEM1C">PEM1C</option>
							<option value="PEM2C">PEM2C</option>
							<option value="PEM3C">PEM3C</option>
							<option value="PEM4C">PEM4C</option>
							</select>
						</th></tr>
                        <tr align="left"><th>Proyecto :</th><th><input name="proy"   type="text" placeholder="proy" value="<?php echo !empty($proy)?$proy:'';?>"></th></tr>
		         <tr><th colspan="2"><input type="submit" value="Dar de alta"></th></tr>
            </table>
        </form>
        <br>
     </div>
  </body>
</html>
