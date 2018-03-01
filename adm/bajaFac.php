<?php
    require '../database.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM facturas  WHERE idfactura = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: bmFac.php");
         
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
        <div class="row">
            <h3>Borrado de Factura</h3>
        </div>
                     
        <form class="form-horizontal" action="bajaFac.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>"/>
                 <p class="alert alert-error">Esta seguro que quiere eliminar el registro ?</p>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-danger">SI</button>
                        <a class="btn" href="bmPer.php">No</a>
                    </div>
            </form>
   </div>                 
</body>
</html>
