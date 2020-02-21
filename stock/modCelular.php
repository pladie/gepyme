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

    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if ( null==$id ) {
        header("Location: bmTag.php");
    }

    if ( !empty($_POST)) {
        
      // keep track post values
      $id		= $_POST['id'];
      $marca = $_POST['marca'];
      $mod   = $_POST['mod'];
      $est   = $_POST['est'];
      $serie = $_POST['serie'];
      $asig  = $_POST['asig'];
       
      // validate input
      $valid = true;
       
      // update data
      if ($valid) {
          $pdo = Database::connect();
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "UPDATE stock  set stkmarca = ?, stkmodelo = ?, stkserie = ?, stkasignacion = ?, stkestado = ? WHERE stkid = ?";
          $q = $pdo->prepare($sql);
          $q->execute(array($marca,$mod,$serie,$asig,'ASIGNADO',$id));
          Database::disconnect();
          header("Location: bmCel.php");
      }
  } else {
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT * FROM stock where stkid = ?";
      $q = $pdo->prepare($sql);
      $q->execute(array($id));
      $data  = $q->fetch(PDO::FETCH_ASSOC);
      $marca = $data['stkmarca'];
      $mod   = $data['stkmodelo'];
      $serie = $data['stkserie'];
      $est	= $data['stkestado'];
      $asig  = $data['stkasignacion'];
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
          <h1 class="h3 mb-2 text-gray-800">Reasignacion Celulares.</h1>
            <p class="mb-4">Celular.</p>

            <form action="modTag.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <table class="table" >
                                <tr align="left"><th>Modelo:</th><th><input type="text" id="mod"   name="mod"   tabindex="2" value="<?php echo $mod; ?>"></th></tr>
                                <tr align="left"><th>Serie:</th> <th><input type="text" id="serie" name="serie" tabindex="3" value="<?php echo $serie; ?>"></th></tr>
                <?php
                                        $pdo = Database::connect();
                                        $sql = "SELECT pernombre FROM personas WHERE perestado = 'Empleado' ORDER BY pernombre;";
                                        echo '<tr align="left"><th>Asignacion:</th><th><select name="asig">';
                                        foreach ($pdo->query($sql) as $row) {
                                                echo '<option value="'. $row['pernombre'] . '">'. $row['pernombre'] . '</option>';
                                        }
                                        Database::disconnect();
                                ?>
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
