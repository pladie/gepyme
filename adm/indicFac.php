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

  $pdo = Database::connect();

  $sqlA = "DELETE from factemp;";

  $sqlB = "INSERT factemp ( SELECT provnombre,NULL,NULL,NULL,NULL,NULL FROM proveedores WHERE provestado != 'BAJA' AND protipo = 'NO' ORDER BY 1);";
	
	$sqlC = "UPDATE factemp as t
              set EneMar = (select avg(f.facevalprod)
                              from facturas as f 
                             where t.facproveedor = f.facproveedor
                               and f.facfecha BETWEEN '2019-01-01' AND '2019-03-31'
                          group by f.facproveedor);";

  $sqlD = "UPDATE factemp as t
              set AbrJun = (select avg(f.facevalprod)
                              from facturas as f 
                             where t.facproveedor = f.facproveedor
                               and f.facfecha BETWEEN '2019-04-01' AND '2019-06-30'
                          group by f.facproveedor);";

  $sqlE = "UPDATE factemp as t
              set JulSep = (select avg(f.facevalprod)
                              from facturas as f 
                             where t.facproveedor = f.facproveedor
                               and f.facfecha BETWEEN '2019-07-01' AND '2019-09-30'
                          group by f.facproveedor);";                                    

  $sqlF = "UPDATE factemp as t
              set OctDic = (select avg(f.facevalprod)
                              from facturas as f 
                             where t.facproveedor = f.facproveedor
                               and f.facfecha BETWEEN '2019-10-01' AND '2019-12-31'
                          group by f.facproveedor);";

  $sqlG = "UPDATE factemp as t
              set factempAct = (select avg(f.facevalprod)
                                  from facturas as f 
                                 where t.facproveedor = f.facproveedor
                                   and f.facfecha BETWEEN '2020-01-01' AND '2020-03-31'
                              group by f.facproveedor);";

	$pdo->query($sqlA);
	$pdo->query($sqlB);
	$pdo->query($sqlC);
	$pdo->query($sqlD);
	$pdo->query($sqlE);
	$pdo->query($sqlF);
	$pdo->query($sqlG);
	
	$sql1 = "SELECT facproveedor,
                  CASE EneMar WHEN 1 THEN 'Malo' WHEN 2 THEN 'Regular' WHEN 3 THEN 'Bueno' WHEN 4 THEN 'Excelente' ELSE 'N/A' END AS EneMar,
                  CASE AbrJun WHEN 1 THEN 'Malo' WHEN 2 THEN 'Regular' WHEN 3 THEN 'Bueno' WHEN 4 THEN 'Excelente' ELSE 'N/A' END AS AbrJun,
                  CASE JulSep WHEN 1 THEN 'Malo' WHEN 2 THEN 'Regular' WHEN 3 THEN 'Bueno' WHEN 4 THEN 'Excelente' ELSE 'N/A' END AS JulSep,
                  CASE OctDic WHEN 1 THEN 'Malo' WHEN 2 THEN 'Regular' WHEN 3 THEN 'Bueno' WHEN 4 THEN 'Excelente' ELSE 'N/A' END AS OctDic,
                  CASE factempAct WHEN 1 THEN 'Malo' WHEN 2 THEN 'Regular' WHEN 3 THEN 'Bueno' WHEN 4 THEN 'Excelente' ELSE 'N/A' END AS factempAct
             FROM factemp;";

  Database::disconnect();
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

  <!-- Custom fonts for this template -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -------------------------------------------------------------------------------------->
    <?php include "../sidebar.php" ?>
    <!-- End of Sidebar ------------------------------------------------------------------------------------------->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include "../topbar.php" ?>
        <!-- End of Topbar ------------------------------------------------------------------------------------------->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Evolución de proveedores con factura.</h1>
            <a href="exportToCSV.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Descargar en CSV</a>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr><th>Proveedor</th><th>EneMar</th><th>AbrJun</th><th>JulSep</th><th>OctDic</th><th>Actual</th></tr>
                  </thead>
                  <tfoot>
                    <tr><th>Proveedor</th><th>EneMar</th><th>AbrJun</th><th>JulSep</th><th>OctDic</th><th>Actual</th></tr>
                  </tfoot>
                  <tbody>
                    <?php
                      foreach ($pdo->query($sql1) as $row) {
                        echo '<tr>';
                        echo '<td>'. $row['facproveedor'] . '</td>';
                        echo '<td>'. $row['EneMar'] . '</td>';
                        echo '<td>'. $row['AbrJun'] . '</td>';
                        echo '<td>'. $row['JulSep'] . '</td>';
                        echo '<td>'. $row['OctDic'] . '</td>';
                        echo '<td>'. $row['factempAct'] . '</td>';
                        echo '</tr>';
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer ----------------------------------------------------------------------------------------------------->
      <?php include "../footer.php" ?>
      <!-- End of Footer ----------------------------------------------------------------------------------------------->

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

  <!-- Page level custom scripts -->
  <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>
