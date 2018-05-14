<?php
    require '../database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: bmFac.php");
    }
     
    if ( !empty($_POST)) {
        
        // keep track post values
        $id		= $_POST['id'];
        $comp	= $_POST['comp'];
        $prov  = $_POST['prov'];
        $fec   = $_POST['fec'];
        $imp   = $_POST['imp'];
        $evadm = $_POST['evadm'];
        $evpro = $_POST['evpro'];
         
        // validate input
        $valid = true;
      
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE facturas set facnro = ?, facfecha = ?, facproveedor = ?, facimporte = ?, facevaladmin = ?, facevalprod = ? WHERE facid = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($comp,$fec,$prov,$imp,$evadm,$evpro,$id));
            Database::disconnect();
            header("Location: bmFac.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM facturas where facid = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data  = $q->fetch(PDO::FETCH_ASSOC);
        $comp  = $data['facnro'];
        $fec   = $data['facfecha'];
        $prov  = $data['facproveedor'];
        $imp   = $data['facimporte'];
        $evadm = $data['facevaladmin'];
        $evpro = $data['facevalprod'];
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
<form action="modFac.php" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
	<table class="table" >
		<thead><tr><th colspan="2">Actualizacion de datos de la Factura</th></tr></thead>		
		<tr><th>Factura:</th>        <th><input type="text" id="comp"  name="comp" tabindex="1" value="<?php echo $comp; ?>"></th></tr>
		<tr><th>Proveedor:</th>      <th><input type="text" id="prov"  name="prov" tabindex="2" value="<?php echo $prov; ?>"></th></tr>
		<tr><th>Fecha:</th>          <th><input type="date" id="fec"   name="fec"  tabindex="3" value="<?php echo $fec; ?>"></th></tr>
		<tr><th>Importe:</th>        <th><input type="text" id="imp"   name="imp"  tabindex="4" value="<?php echo $imp; ?>"></th></tr>
		<tr><th>Ev. Admin.:</th>     <th><input type="text" id="evadm" name="evadm"tabindex="5" value="<?php echo $evadm; ?>"></th></tr>
		<tr><th>Ev. Prod./Serv.:</th><th><input type="text" id="evpro" name="evpro"tabindex="6" value="<?php echo $evpro; ?>"></th></tr>
		<tr><th colspan="2"><input type="submit" value="Actualizar" ></th></tr>
	</table>
</form>
</div>
       
  </body>
</html>
