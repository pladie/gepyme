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
      // keep track validation errors
      $marca = null;
      $mod   = null;
      $serie = null;
      $plan  = null;
      $nro   = null;
      $proy  = null;
       
      // keep track post values
      $marca = $_POST['marca'];
      $mod   = $_POST['mod'];
      $serie = $_POST['serie'];
      $plan  = $_POST['plan'];
      $nro   = $_POST['nro'];
      $proy  = $_POST['proy'];
       
      // validate input
      $valid = true;
      if (empty($marca)) {
          $marca = 'Please enter Name';
          $valid = false;
      }
      
      // insert data
      if ($valid) {
          $pdo = Database::connect();
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
          $sql = "INSERT INTO stock (stkmarca,stkmodelo,stkserie,stkasignacion,stkestado,stktipo,stkplan,stknumero,stkproyecto) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
          $q = $pdo->prepare($sql);
          $q->execute(array($marca,$mod,$serie,'STOCK','ASIGNADO','Linea',$plan,$nro,$proy));
          
          $sql = "INSERT INTO log (logtrans,logserie,logitem) values(?, ?, ?)";
          $q = $pdo->prepare($sql);
          $q->execute(array('ALTA Linea->STOCK',$serie,'STOCK'));
                   
          Database::disconnect();
          header("Location: bmLin.php");
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


        <h3>Alta de Línea</h3>
        <form class="form-horizontal" action="altaLin.php" method="post">
        		<table class="table" >
        			<tr align="left"><th>Marca :</th>
						    <th><select name="marca">
							    <option value="Claro-ATX">Claro-ATX</option>
							    <option value="Movistar-Lugalu">Movistar-Lugalu</option>
							    <option value="Personal-Lugalu">Personal-Lugalu</option>
							    <option value="Nextel">Nextel</option>
							    </select>
						    </th>
              </tr>             
             	<tr align="left"><th>Modelo :</th><th><input name="mod"   type="text" placeholder="Modelo" value="<?php echo !empty($mod)?$mod:'';?>">    </th></tr>
		        <tr align="left"><th>Numero :</th><th><input name="nro"   type="text" placeholder="Numero" value="<?php echo !empty($nro)?$nro:'';?>"></th></tr>
                <tr align="left"><th>Serie  :</th><th><input name="serie" type="text" placeholder="Serie"  value="<?php echo !empty($serie)?$serie:'';?>"></th></tr>
					<tr align="left"><th>Plan :</th>
						<th><select name="plan">
							<option value="BAM06">BEM06</option>
							<option value="BAM21">BEM21</option>
              <option value="BAM32">BEM32</option>
              <option value="BAM33">BEM33</option>
							<option value="PEM1C">PEM1C</option>
							<option value="PEM2C">PEM2C</option>
							<option value="PEM3C">PEM3C</option>
							<option value="PEM4C">PEM4C</option>
							</select>
						</th></tr>
          <tr align="left"><th>Proyecto :</th>
            <th><select name="proy">
              <option value="atx">Sondeos</option>
              <option value="lugalu">AreaIT</option>
							</select>
            </th>
          </tr>
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
