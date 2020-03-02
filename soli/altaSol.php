<?php
    session_start(); 

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: ../web/index.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: ../web/index.php");
    }

    require_once '../database.php';

    if ( !empty($_POST)) {
        // keep track validation errors
        $tipo = null;
        $desc = null;

        // keep track post values
        $tipo = $_POST['tipo'];
        $desc = $_POST['desc'];

        // validate input
        $valid = true;
        if (empty($tipo)) {
            $valid = false;
        }

        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO solicitudes (soltipo,solDescripcion) values (?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($tipo,$desc));

            $sql = "INSERT INTO log (logtrans,logserie,logitem) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array('ALTA->Solicitud',0,$desc));

            Database::disconnect();
            header("Location: altaSol.php");
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

            <h3>Ingreso de Solicitudes</h3>
            <form class="form-horizontal" action="altaSol.php" method="post">
              <table class="table" >
                <tr align="left"><th>Tipo :</th><th><input name="tipo" type="text" placeholder="Tipo" value="<?php echo !empty($tipo)?$tipo:'';?>">    </th></tr>
                <tr align="left"><th>Descripcion  :</th><th><input name="desc"  type="text" placeholder="Descripcion"  value="<?php echo !empty($desc)?$desc:'';?>"></th></tr>
                <tr><th colspan="2"><input type="submit" value="Dar de alta"></th></tr>
              </table>
            </form>

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
