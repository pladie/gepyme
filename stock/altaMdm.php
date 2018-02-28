<?php
    require 'database.php';
 
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
            
            $sql = "INSERT INTO stock (stkmarca,stkmodelo,stkserie,stkasignacion,stktipo) values(?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($marca,$mod,$serie,'STOCK','Modem'));
            
            $sql = "INSERT INTO log (logtrans,logserie,logitem) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array('ALTA->STOCK',$serie,'STOCK'));
                     
            Database::disconnect();
            header("Location: bmMdm.php");
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
        <h3>Alta de Modem</h3>
        <form class="form-horizontal" action="altaMdm.php" method="post">
        		<table class="table" >
						<tr align="left"><th>Marca :</th>     <th><input name="marca" type="text" placeholder="Marca"      value="<?php echo !empty($marca)?$marca:'';?>"></th></tr>             
             		<tr align="left"><th>Modelo :</th>    <th><input name="mod"   type="text" placeholder="Modelo"     value="<?php echo !empty($mod)?$mod:'';?>">    </th></tr>
		            <tr align="left"><th>Serie :</th>     <th><input name="serie" type="text" placeholder="Serie"      value="<?php echo !empty($serie)?$serie:'';?>"></th></tr>
		            <tr><th colspan="2"><input type="submit" value="Dar de alta"></th></tr>
            </table>
            <br>
            <a href="menuStock.php">Volver</a>
        </form>
     </div>
  </body>
</html>
