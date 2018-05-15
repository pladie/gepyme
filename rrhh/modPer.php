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
    	$id	   = $_POST['id'];
    	$nom	   = $_POST['nom'];
    	$dni	   = $_POST['dni'];
    	$estado  = $_POST['estado'];
    	$fecalta = $_POST['fecalta'];
    	$fecbaja = $_POST['fecbaja'];
    	$valid   = true;
      
      if ($valid) {
      	$pdo = Database::connect();
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "UPDATE personas set pernombre = ?, perdni = ?, perestado = ?, perfecalta = ?, perfecbaja = ? WHERE perid = ?";
         $q = $pdo->prepare($sql);
         $q->execute(array($nom,$dni,$estado,$fecalta,$fecbaja,$id));
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
        $nom	  = $data['pernombre'];
        $dni	  = $data['perdni'];
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
	<p class="title"><strong>Actualizacion de datos de la Persona</strong>
	<form action="modPer.php" method="post">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
		<table class="table" >
			<tr><th>Nombre :</th><th><input type="text" id="nom"     name="nom"     tabindex="1" value="<?php echo $nom; ?>"></th></tr>
			<tr><th>DNI    :</th><th><input type="text" id="dni"     name="dni"     tabindex="2" value="<?php echo $dni; ?>"></th></tr>
			<tr><th>Estado :</th><th><input type="text" id="estado"  name="estado"  tabindex="3" value="<?php echo $estado; ?>"></th></tr>
			<tr><th>Alta   :</th><th><input type="date" id="fecalta" name="fecalta" tabindex="4" value="<?php echo $fecalta; ?>"></th></tr>
			<tr><th>Baja   :</th><th><input type="date" id="fecbaja" name="fecbaja" tabindex="5" value="<?php echo $fecbaja; ?>"></th></tr>
			<tr><th colspan="2"><input type="submit" value="Actualizar" ></th></tr>
		</table>
	</form>
</div>
<br>
   <div class="volver">
		<a href="./bmPer.php" target="content">Volver</a>
	</div>
</body>
</html>