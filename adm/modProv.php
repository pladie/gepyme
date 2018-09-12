<?php
    require '../database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: bmProv.php");
    }
     
    if ( !empty($_POST)) {
    	$id	 = $_POST['id'];
    	$nom	 = $_POST['nom'];
    	$open  = $_POST['open'];
    	$valid = true;
      
      if ($valid) {
      	if($open = "checked") {
      		$open = 1;
      	}
      	$pdo = Database::connect();
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "UPDATE proveedores set provnombre = ?, protipo = ? WHERE provid = ?";
         $q = $pdo->prepare($sql);
         $q->execute(array($nom,$open,$id));
         Database::disconnect();
         header("Location: bmProv.php");

        $trx= date("YmdHis");
        $text= 'Alta-> ' . $nom . '| Habilitado ' . '|' . $protipo;
        $sql = "INSERT INTO log (logserie,loglong) values(?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($trx,$text));
      }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM proveedores where provid = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data  = $q->fetch(PDO::FETCH_ASSOC);
        $nom   = $data['provnombre'];
        $open  = $data['protipo'];
        
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
<div align="left" class="volver">
	<a href="./menuAdm.php" target="content" align="left">Volver</a>
</div>
<div align="center">
	<h3>Actualizacion de datos del Proveedor</h3>
	<form action="modProv.php" method="post">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
		<table align="center" class="tableli" >
			<tr><th>Razon Social :</th><th><input type="text" id="nom"  name="nom" tabindex="1" value="<?php echo $nom; ?>"></th></tr>
			<tr><th>Open Source  :</th><th><input type="checkbox" id="open"  name="open" tabindex="2" <?php if ($open) {echo 'checked';};?>></th></tr>
			<tr  ><th colspan="2" align="center"><input type="submit" value="Actualizar" ></th></tr>
		</table>
	</form>
</div>
</body>
</html>

