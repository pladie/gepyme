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

    require_once '../database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
      
    if ( null==$id ) {
        header("Location: bmPer.php");
    }

	   if ( !empty($_POST)) {
    	$id	   = $_POST['id'];
    	$nom	   = $_POST['nom'];
    	$dni	   = $_POST['dni'];
    	$estado  = $_POST['estado'];
    	$fecalta = $_POST['fecalta'];
    	$fecbaja = $_POST['fecbaja'];
    	$asig		= $_POST['asig'];
    	$valid   = true;
      
      if ($valid) {
      	$pdo = Database::connect();
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "UPDATE personas set pernombre = ?, perdni = ?, perestado = ?, perasig = ?, perfecalta = ?, perfecbaja = ? WHERE perid = ?";
         $q = $pdo->prepare($sql);
         $q->execute(array($nom,$dni,$estado,$asig,$fecalta,$fecbaja,$id));
         Database::disconnect();
         header("Location: bmPer.php");
      }
      } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM personas where perid = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data    = $q->fetch(PDO::FETCH_ASSOC);
        $nom	  = $data['pernombre'];
        $dni	  = $data['perdni'];
        $estado  = $data['perestado'];
        $asig    = $data['perasig'];
        $fecalta = $data['perfecalta'];
        $fecbaja = $data['perfecbaja'];
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
          <h1 class="h3 mb-2 text-gray-800">Modificacino de Persona.</h1>
          <form action="modPersona.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <table class="table" >
                <tr><th>Nombre   :</th><th><input type="text" id="nom"     name="nom"     tabindex="1" value="<?php echo $nom; ?>"></th></tr>
                <tr><th>DNI      :</th><th><input type="text" id="dni"     name="dni"     tabindex="2" value="<?php echo $dni; ?>"></th></tr>
                <tr><th>Estado   :</th><th><input type="text" id="estado"  name="estado"  tabindex="3" value="<?php echo $estado; ?>"></th></tr>
                <tr><th>Proyecto :</th><th><input type="text" id="asig"    name="asig"    tabindex="4" value="<?php echo $asig; ?>"></th></tr>			
                <tr><th>Alta     :</th><th><input type="date" id="fecalta" name="fecalta" tabindex="5" value="<?php echo $fecalta; ?>"></th></tr>
                <tr><th>Baja     :</th><th><input type="date" id="fecbaja" name="fecbaja" tabindex="6" value="<?php echo $fecbaja; ?>"></th></tr>
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
