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
        
        // keep track post values
        $id		= $_POST['id'];
        $nom	= $_POST['nom'];
         
        // validate input
        $valid = true;
      
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE proveedores set provnombre = ? WHERE provid = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($nom,$id));
            Database::disconnect();
            header("Location: bmProv.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM proveedores where provid = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data  = $q->fetch(PDO::FETCH_ASSOC);
        $nom  = $data['provnombre'];
        
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
	<h3>Actualizacion de datos del Proveedor</h3>
	<form action="modProv.php" method="post">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
		<table class="table" >
			<tr><th>Nombre :</th><th><input type="text" id="nom"  name="nom" tabindex="1" value="<?php echo $nom; ?>"></th></tr>
			<tr><th colspan="2"><input type="submit" value="Actualizar" ></th></tr>
		</table>
	</form>
</div>
</body>
</html>

