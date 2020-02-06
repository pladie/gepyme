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
        $comp  = null;
        $prov  = null;
        $fec   = null;
        $imp   = null;
        $evadm = null;
        $evpro = null;

        $comp  = $_POST['comp'];
        $prov  = $_POST['prov'];
        $fec   = $_POST['fec'];
        $imp   = $_POST['imp'];
        $evadm = $_POST['evadm'];
        $evpro = $_POST['evpro'];

        $valid = true;

        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO facturas (facnro, facfecha, facproveedor, facimporte, facevaladmin, facevalprod) values(?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($comp,$fec,$prov,$imp,$evadm,$evpro));

            $trx= date("YmdHMS");
            $text= 'Alta-> ' . $comp . '|' . $prov . '|' . $imp . '|' . $evadm. '|' . $evpro;
            $sql = "INSERT INTO log (logserie,loglong) values(?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($trx,$text));

            Database::disconnect();
            header("Location: altaFactura.php");
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

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Ingreso de Facturas</h1>

        <!-- <form class="user"> -->
        <form class="form-horizontal" action="altaFactura.php" method="post">
            <table class="tableli" >
                <tr align="left"><th>Factura:</th>   <th><input name="comp" type="text" placeholder="Factura"   value="<?php echo !empty($comp)?$comp:'';?>"></th></tr>
                <tr align="left"><th>Fec. Comp.:</th><th><input name="fec"  type="date" placeholder="Fecha"     value="<?php echo !empty($fec)?$fec:'';?>"> </th></tr>
                <?php
                    $pdo = Database::connect();
                    $sql = "SELECT provnombre FROM proveedores WHERE provestado != 'BAJA' AND protipo = 'NO' ORDER BY provnombre;";
                    echo '<tr align="left"><th>Proveedor:</th><th><select name="prov">';
                    foreach ($pdo->query($sql) as $row) {
                        echo '<option value="'. $row['provnombre'] . '">'. $row['provnombre'] . '</option>';
                    }
                ?>
                <tr align="left"><th>Importe:</th>   <th><input name="imp"  type="text" placeholder="Importe"   value="<?php echo !empty($imp)?$imp:'';?>"> </th></tr>
                <tr><th><br></th></tr>
                <tr align="left"><th>Ev. Prod./Serv.:</th>
                    <th><select name="evpro">
                            <option value="N/A">N/A</option>
                            <option value="Malo">Malo</option>
                            <option value="Regular">Regular</option>
                            <option value="Bueno">Bueno</option>
                            <option value="Excelente">Excelente</option>
                        </select>
                    </th>
                </tr> 
                <tr><th><br></th></tr>
                <tr align="center"><th colspan="2"><input type="submit" value="Dar de alta"></th></tr>
         </table>
       </form>
        </div>
        <!-- /.container-fluid -->

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
