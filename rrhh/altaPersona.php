<?php

    session_start();

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: ../web');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: ../web");
    }

    require_once '../database.php';

    if ( !empty($_POST)) {
        // keep track validation errors
        $nombre = null;
        $dni    = null;
        $estado = null;
        $fecha  = null;
        $asig	= null;
         
        // keep track post values
        $nombre = $_POST['nombre'];
        $dni    = $_POST['dni'];
		$estado = $_POST['estado'];
        $fecha  = $_POST['fecha'];
        $asig   = $_POST['asignacion'];
         
        // validate input
        $valid = true;
        if (empty($nombre)) {
            $nombre = 'Please enter Name';
            $valid = false;
        }
        
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "INSERT INTO personas (pernombre,perdni,perestado,perfecalta,perasig) values(?, ?, ?, ? ,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nombre,$dni,$estado,$fecha,$asig));
            
            Database::disconnect();
            header("Location: bmPer.php");
        }
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

            <h3>Alta de Celular</h3>
            <form class="form-horizontal" action="altaPersona.php" method="post">
                <table class="table">
                    <tr><th>Nombre :</th> <th><input name="nombre" type="text" placeholder="Nombre" value="<?php echo !empty($nombre)?$nombre:'';?>"></th></tr>
                    <tr><th>DNI :</th>    <th><input name="dni"    type="text" placeholder="DNI"    value="<?php echo !empty($dni)?$dni:'';?>"></th></tr>
                    <tr><th>Estado :</th> <th><input name="estado" type="text" placeholder="Estado" value="<?php echo !empty($estado)?$estado:'';?>"></th></tr>
                    <tr><th>Fecha :</th>  <th><input name="fecha"  type="date" placeholder="fecha"  value="<?php echo !empty($fecha)?$fecha:'';?>"></th></tr>
                    <tr><th>Pryecto :</th><th><input name="asig"   type="text" placeholder="asig"   value="<?php echo !empty($asig)?$asig:'';?>"></th></tr>
                    <tr><th colspan="2"><input type="submit" value="Dar de alta"></th></tr>
                </table>
            </form>
            <br>
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

	</body>
</html>