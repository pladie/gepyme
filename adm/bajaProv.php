<?php
    require '../database.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        $id = $_POST['id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE proveedores SET provestado = 'BAJA' WHERE provid = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));     
        
        Database::disconnect();
        header("Location: bmProv.php");         
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
      <h3>Borrado de Proveedor</h3>
      <form class="form-horizontal" action="bajaProv.php" method="post">
         <input type="hidden" name="id" value="<?php echo $id;?>"/>
            <p class="alert alert-error">Esta seguro que quiere eliminar el registro ?</p>
            <button type="submit" class="btn btn-danger">SI</button>
            <a class="btn" href="bmProv.php">No</a>
      </form>
   </div>                 
</body>
</html>
