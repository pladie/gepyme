<?php
    require '../database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $marca = null;
        $mod   = null;
        $serie = null;
         
        // keep track post values
        $marca = $_POST['marca'];
        $mod   = $_POST['mod'];
        $serie = $_POST['serie'];
         
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
            
            $sql = "INSERT INTO stockExternos (stkemarca,stkemodelo,stkeserie,stkeasignacion,stkeestado,stketipo) values(?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($marca,$mod,$serie,'STOCK','ASIGNADO','Redes'));
            
            $sql = "INSERT INTO log (logtrans,logserie,logitem) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array('ALTA->STOCK',$serie,'STOCK Externo'));
                     
            Database::disconnect();
            header("Location: bmExterno.php");
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
	    <a href="./menuStock.php">Volver</a>
    </div>
    <div align="center">
       <h3>Alta de Bien</h3>
        <form class="form-horizontal" action="altaExterno.php" method="post">
        	<table class="table" >
				<tr align="left"><th>Marca :</th>     <th><input name="marca" type="text" placeholder="Marca"      value="<?php echo !empty($marca)?$marca:'';?>"></th></tr>             
            	<tr align="left"><th>Modelo :</th>    <th><input name="mod"   type="text" placeholder="Modelo"     value="<?php echo !empty($mod)?$mod:'';?>">    </th></tr>
		        <tr align="left"><th>Serie :</th>     <th><input name="serie" type="text" placeholder="Serie"      value="<?php echo !empty($serie)?$serie:'';?>"></th></tr>
		        <tr><th colspan="2"><input type="submit" value="Dar de alta"></th></tr>
            </table>
        </form>
    </div>
</body>
</html>