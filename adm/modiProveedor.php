<?php
    session_start(); 

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: ../web/');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: ../web/");
    }

    $id = null;

    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if ( null==$id ) {
        header("Location: bmProveedor.php");
    }

    require_once '../database.php';

    Database::disconnect();
     
  if ( !empty($_POST)) {

      // keep track post values
      $id	 = $_POST['id'];
      $prov  = $_POST['prov'];
      $est   = $_POST['est'];
      if ($_POST['tipo'] == 'S/Fac.') { $tipo  = 'NO'; } else { $tipo  = 'SI'; };

      // validate input
      $valid = true;

      if ($valid) {
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE proveedores set provnombre = ?, provestado = ?, protipo = ? WHERE provid = ?";
      $q = $pdo->prepare($sql);
      $q->execute(array($prov,$est,$tipo,$id));

      Database::disconnect();
      header("Location: modiProveedor.php");

      }
  } else {
      $id		= $_GET['id'];
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT provnombre,
                     provestado,
                     CASE protipo WHEN 'SI' THEN 'S/Fac.' WHEN 'NO' THEN 'S/Fac.' ELSE 'N/A' END as protipo 
                FROM proveedores WHERE provid = ? ORDER BY provnombre ASC";
      $q = $pdo->prepare($sql);
      $q->execute(array($id));
      $data  = $q->fetch(PDO::FETCH_ASSOC);
      $prov  = $data['provnombre'];
      $est   = $data['provestado'];
      $tipo  = $data['protipo'];
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
          <h1 class="h3 mb-2 text-gray-800">Proveedore a modificar.</h1>

          <form action="modiProveedor.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <table class="tablei" >
              <thead><tr><th colspan="2">Actualizacion de datos del Proveedor.</th></tr></thead>		
              <tr><th>Proveedor:</th><th><input type="text" id="prov" name="prov" tabindex="1" value="<?php echo $prov; ?>"></th></tr>
              <tr><th>Estado:</th>   <th><input type="text" id="est"  name="est"  tabindex="2" value="<?php echo $est; ?>"></th></tr>
              <tr><th>Tipo:</th>     <th><input type="text" id="tipo" name="tipo" tabindex="3" value="<?php echo $tipo; ?>"></th></tr>
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
