<?php
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
  }

  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ../index.php");
  }

  require_once '../database.php';

  if ( !empty($_POST)) {
    $nom  = null;
    $open = null;

    $nom  = $_POST['nom'];
    $open = $_POST['open'];

    $valid = true;

    if ($valid) {
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "INSERT INTO proveedores (provnombre, provestado, protipo) values(?, ?, ?)";
      $q = $pdo->prepare($sql);
      $q->execute(array($nom,'Habilitado',$open));

      $trx= date("YmdHis");
      $text= 'Alta-> ' . $nom . '| Habilitado ' . '|' . $open;
      $sql = "INSERT INTO log (logserie,loglong) values(?, ?)";
      $q = $pdo->prepare($sql);
      $q->execute(array($trx,$text));

      Database::disconnect();
      header("Location: bmProv.php");
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

        <!-- Topbar ------------------------------------------------------------------------------------->
        <?php include "../topbar.php" ?>
        <!-- End of Topbar ------------------------------------------------------------------------------>

        <!-- Begin Page Content ------------------------------------------------------------------------->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Alta de Proveedores</h1>

          <!-- <form class="user"> -->
          <form class="form-horizontal" action="altaProv.php" method="post">
            <table class="tablei" >
              <tr align="left"><th>Razón Social :</th>   <th><input name="nom" type="text" placeholder="Razón Social"   value="<?php echo !empty($nom)?$nom:'';?>"></th></tr>
              <tr><th>Open Source  :</th>
                <th><select name="open">
                  <option value="NO">NO</option>
                  <option value="SI">SI</option>
                  </select>
                </th>
              </tr>
              <tr><th><br></th></tr>
              <tr><th colspan="2"><input type="submit" value="Dar de alta"></th></tr>
            </table>
          </form>
          <!-- /.container-fluid -->
          </div>
        <!-- End of Main Content ------------------------------------------------------------------------------>
        </div>
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
