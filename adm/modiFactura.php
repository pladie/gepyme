<?php
    session_start(); 

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: ../home.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: ../index.php");
    }

    $id = null;

    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if ( null==$id ) {
        header("Location: bmFactura.php");
    }

    require_once '../database.php';

    Database::disconnect();
     
  if ( !empty($_POST)) {

      // keep track post values
      $id		= $_POST['id'];
      $comp	= $_POST['comp'];
      $prov  = $_POST['prov'];
      $fec   = $_POST['fec'];
      $imp   = $_POST['imp'];
      $evpro = $_POST['evpro'];

      // validate input
      $valid = true;

      if ($valid) {
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE facturas set facnro = ?, facfecha = ?, facproveedor = ?, facimporte = ?, facevalprod = ? WHERE facid = ?";
      $q = $pdo->prepare($sql);
      $q->execute(array($comp,$fec,$prov,$imp,$evadm,$evpro,$id));
      Database::disconnect();
      header("Location: modiFactura.php");
      }
  } else {
      $id		= $_GET['id'];
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
      $evpro = $data['facevalprod'];
      Database::disconnect();
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>GePyME</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -------------------------------------------------------------------------------------->
    <?php include "../sidebar.php" ?>
    <!-- End of Sidebar ------------------------------------------------------------------------------------->

    <!-- Content Wrapper ------------------------------------------------------------------------------------>
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar ----------------------------------------------------------------------------------------->
        <?php include "../topbar.php" ?>
        <!-- End of Topbar ---------------------------------------------------------------------------------->

        <!-- Begin Page Content ----------------------------------------------------------------------------->
        <div class="container-fluid">

          <!-- <form class="user"> -->
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Listado de facturas.</h1>
            <p class="mb-4">Facturas ordenadas desde la mas reciente.</p>

          <form action="modFac.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <table class="tablei" >
              <thead><tr><th colspan="2">Actualizacion de datos de la Factura</th></tr></thead>		
              <tr><th>Factura:</th>        <th><input type="text" id="comp"  name="comp" tabindex="1" value="<?php echo $comp; ?>"></th></tr>
              <tr><th>Proveedor:</th>      <th><input type="text" id="prov"  name="prov" tabindex="2" value="<?php echo $prov; ?>"></th></tr>
              <tr><th>Fecha:</th>          <th><input type="date" id="fec"   name="fec"  tabindex="3" value="<?php echo $fec; ?>"></th></tr>
              <tr><th>Importe:</th>        <th><input type="text" id="imp"   name="imp"  tabindex="4" value="<?php echo $imp; ?>"></th></tr>
              <tr><th>Ev. Prod./Serv.:</th><th><input type="text" id="evpro" name="evpro"tabindex="6" value="<?php echo $evpro; ?>"></th></tr>
              <tr><th colspan="2"><input type="submit" value="Actualizar" ></th></tr>
            </table>
          </form>
        </div>
        <!-- End of Page Content ---------------------------------------------------------------------------->
      </div>
      <!-- End of Main Content ------------------------------------------------------------------------------>
      
      <!-- Footer ------------------------------------------------------------------------------------------->
      <?php include "../footer.php" ?>
      <!-- End of Footer ------------------------------------------------------------------------------------>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
  </body>

</html>
