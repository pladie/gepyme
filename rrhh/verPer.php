<?php
    require '../database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: menuRRHH.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM personas where perid = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
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
    	<h3>Ver datos de Persona</h3>
     		<table class="table" >
              <tr align="left"><th>Nombre:</th><th><?php echo $data['pernombre'];?></th></tr>
              <tr align="left"><th>DNI: </th><th><?php echo $data['perdni'];?></th></tr>
				  <tr align="left"><th>Estado:</th><th><?php echo $data['perestado'];?></th></tr>
      </table>
      <br>
      <a href="bmPer.php">Volver</a>
    </div>
  </body>
</html>
