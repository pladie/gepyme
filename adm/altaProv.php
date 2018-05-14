<?php
    require '../database.php';
 
    if ( !empty($_POST)) {
        $nom  = null;
    	
        $nom  = $_POST['nom'];
        
        $valid = true;
       
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "INSERT INTO proveedores (provnombre, provestado) values(?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nom,'Habilitado'));
            
            $trx= date("YmdHis");
            $text= 'Alta-> ' . $nom;
            $sql = "INSERT INTO log (logserie,loglong) values(?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($trx,$text));
                     
            Database::disconnect();
            header("Location: bmProv.php");
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
		<p class="title"><strong>Alta de Proveedor</strong></p>
		<form class="form-horizontal" action="altaProv.php" method="post">
			<table class="table" >
				<tr align="left"><th>Razon Social :</th>   <th><input name="nom" type="text" placeholder="Razon Social"   value="<?php echo !empty($nom)?$nom:'';?>"></th></tr>
				<tr><th colspan="2"><input type="submit" value="Dar de alta"></th></tr>       
         </table>
         <br>	
         <div class="volver">
				<a href="./menuAdm.php" target="content">Volver</a>
			</div>
       </form>
    </div>
  </body>
</html>
