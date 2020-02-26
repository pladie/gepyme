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
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


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
        <h1 class="h3 mb-2 text-gray-800">Listado de Celulares.</h1>
          <p class="mb-4">Celulares en stock.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Marca</th>
                      <th>Modelo</th>
                      <th>Serie</th>
                      <th>Asignacion</th>
                      <th>Detalle</th>
                      <th>Asignar</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Marca</th>
                      <th>Modelo</th>
                      <th>Serie</th>
                      <th>Asignacion</th>
                      <th>Detalle</th>
                      <th>Asignar</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                      $pdo = Database::connect();
                      $sql = 'SELECT * FROM stock WHERE stktipo = "Celular" AND stkestado NOT IN ("BAJA") ORDER BY stkmarca,stkmodelo';
                      foreach ($pdo->query($sql) as $row) {
               	        echo '<tr>';
                        echo '<td>'. $row['stkmarca'] . '</td>';
                        echo '<td>'. $row['stkmodelo'] . '</td>';
                        echo '<td>'. $row['stkserie'] . '</td>';
                        echo '<td>'. $row['stkasignacion'] . '</td>';
                        echo '<td align="center">';
                        echo '  <a class="btn btn-info btn-circle btn-sm" href="modCelular.php?id='.$row['stkid'].'" >';
                        echo '    <i class="fas fa-info"></i>';
                        echo '  </a>';
                        echo '</td> ';
                        echo '<td align="center">';
                        echo '  <a href="bajaTag.php?id='.$row['stkid'].'" class="btn btn-success btn-circle btn-sm">';
                        echo '    <i class="fas fa-check"></i>';
                        echo '  </a>';
                        echo '</td>';
                        echo '</tr>';
                      }
                      Database::disconnect();
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
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

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/datatables-demo.js"></script>


</body>

</html>
