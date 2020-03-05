<?php
    
  require_once '../database.php';

  // Busco al usuario y sus privilegios para mostrar menu

  if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: ./web');
	}

	$pdo = Database::connect();

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM users where usunombre = ?";

	$q = $pdo->prepare($sql);
	$q->execute(array($_SESSION['username']));
	$data  = $q->fetch(PDO::FETCH_ASSOC);
	$usuValido = $data['usuestado'];
	$privadm = $data['privA'];
	$privrrhh = $data['privR'];
	$privstock = $data['privS'];
	$privpanel = $data['privP'];
	$privsuper = $data['superuser'];

	Database::disconnect();
?>

    <!-- Sidebar -------------------------------------------------------------------------------------->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
        <div class="sidebar-brand-text mx-3">GePyME</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Item de Navegacion -->
      <li class="nav-item active">
        <a class="nav-link">
          <span>Gestión de Pequeñas y Medianas Empresas</span>
        </a>
        <hr class="sidebar-divider d-none d-md-block">
        <a class="nav-link"> 
          <span>Módulos</span>
        </a>
      </li>

      <!-- Despliegue de Modulos autorizados -->
      <?php 
        $adm     = `sqlite3 -noheader ../system.sqlite3 "select valor from system where param='admin'    and modulo='system';"`;
        $rrhh    = `sqlite3 -noheader ../system.sqlite3 "select valor from system where param='rrhh'     and modulo='system';"`;
        $stock   = `sqlite3 -noheader ../system.sqlite3 "select valor from system where param='stock'    and modulo='system';"`;
        $tablero = `sqlite3 -noheader ../system.sqlite3 "select valor from system where param='tablero'  and modulo='system';"`;
        
        if(1 == $adm && $privadm >= 0) {
          echo '  <li class="nav-item">';
          echo '    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmin" aria-expanded="true" aria-controls="collapseAdmin">';
          echo '      <i class="fas fa-fw fa-folder"></i>';
          echo '      <span>Administración</span>';
          echo '    </a>';
          if($privadm == 1) {
            echo '  <div id="collapseAdmin" class="collapse" aria-labelledby="headingAdmin" data-parent="#accordionSidebar">';
            echo '    <div class="bg-white py-2 collapse-inner rounded">';            
            echo '      <h6 class="collapse-header">Facturas:</h6>';
            echo '          <a class="collapse-item" href="../adm/altaFactura.php">Ingreso de Facturas</a>';
            echo '          <a class="collapse-item" href="../adm/bmFactura.php">Modificación de Facturas</a>';
            echo '          <a class="collapse-item" href="../adm/verFactura.php">Visualización de Facturas</a>';
            echo '      <h6 class="collapse-header">Proveedores:</h6>';
            echo '          <a class="collapse-item" href="../adm/altaProveedor.php">Alta de Proveedor</a>';
            echo '      <h6 class="collapse-header">Indicadores:</h6>';
            echo '          <a class="collapse-item" href="../adm/indicFac.php">Ev. Prov. C/Fact.</a>';
            echo '    </div>';
            echo '  </div>';
            echo '</li>';
          }
        }
        if(1 == $adm && $privrrhh >= 0) {
          echo '  <li class="nav-item">';
          echo '    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRH" aria-expanded="true" aria-controls="collapseRH">';
          echo '      <i class="fas fa-fw fa-folder"></i>';
          echo '      <span>Recursos Humanos</span>';
          echo '    </a>';
          if($privadm == 1) {
            echo '  <div id="collapseRH" class="collapse" aria-labelledby="headingRH" data-parent="#accordionSidebar">';
            echo '    <div class="bg-white py-2 collapse-inner rounded">';            
            echo '      <h6 class="collapse-header">Personas:</h6>';
            echo '          <a class="collapse-item" href="../rrhh/altaPersona.php">Alta de Personas</a>';
            echo '          <a class="collapse-item" href="../rrhh/bmPersona.php">Modificación de Personas</a>';
            //echo '      <h6 class="collapse-header">Entrevistas:</h6>';
            //echo '          <a class="collapse-item" href="#">Agendar Entrevista</a>';
            echo '    </div>';
            echo '  </div>';
            echo '</li>';
          }
        }
        if(1 == $adm && $privstock >= 0) {
          echo '  <li class="nav-item">';
          echo '    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStock" aria-expanded="true" aria-controls="collapseStock">';
          echo '      <i class="fas fa-fw fa-folder"></i>';
          echo '      <span>Stock</span>';
          echo '    </a>';
          if($privadm == 1) {
            echo '  <div id="collapseStock" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">';
            echo '    <div class="bg-white py-2 collapse-inner rounded">';
            echo '      <h6 class="collapse-header">Estadisticas</h6>';
            echo '        <a class="collapse-item" href="../stock/dashboard.php">Dashboard</a>';
            echo '    </div>';
            echo '  </div>';
            echo '</li>';
          }
        }
        if(1 == $adm && $privstock >= 0) {
          echo '  <li class="nav-item">';
          echo '    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSoli" aria-expanded="true" aria-controls="collapseSoli">';
          echo '      <i class="fas fa-fw fa-folder"></i>';
          echo '      <span>Solicitudes</span>';
          echo '    </a>';
          if($privadm == 1) {
            echo '  <div id="collapseSoli" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">';
            echo '    <div class="bg-white py-2 collapse-inner rounded">';
            echo '      <h6 class="collapse-header">Estadisticas</h6>';
            echo '        <a class="collapse-item" href="../soli/altaSol.php">Generar Solicitud</a>';
            echo '    </div>';
            echo '  </div>';
            echo '</li>';
          }
        }
      ?>
       <!-- Divider -->
       <hr class="sidebar-divider my-0">
       <li class="nav-item">
           <a class="nav-link">
                <span>Versión: 
               <?php
                    $ver     = `sqlite3 -noheader ../system.sqlite3 "select valor from system where param='version'  and modulo='system';"`;
                    $rev     = `sqlite3 -noheader ../system.sqlite3 "select valor from system where param='revision' and modulo='system';"`;
                    $fix     = `sqlite3 -noheader ../system.sqlite3 "select valor from system where param='fix'      and modulo='system';"`;
                    echo $ver.'. '.$rev.'. '.$fix; 
                ?>
                </span>
            </a>
        </li>

       <!-- Software ------------------------------------------------------------------------------------>
        <li class="nav-item">
            <hr class="sidebar-divider d-none d-md-block">
            <a class="nav-link"> 
	            <a href="http://www.w3c.org">     <img src="../img/html5.png"    width="30" height="25" alt=""></a>
	            <a href="http://www.w3c.org">     <img src="../img/js.png"       width="30" height="25" alt=""></a>
	            <a href="http://www.w3c.org">     <img src="../img/css3.png"     width="30" height="25" alt=""></a>
              <a href="http://www.debian.org/"> <img src="../img/debian.png"   width="50" height="20" alt=""></a>
              <a href="http://www.php.org/en/"> <img src="../img/php.png"      width="50" height="25" alt=""></a>
	            <a href="http://www.fpdf.org">    <img src="../img/sqlite370_banner.gif" width="55" height="25" alt=""></a>
	            <a href="http://www.mariadb.org/"><img src="../img/mariadb.png"  width="50" height="15" alt=""></a>
              <a href="https://jpgraph.net">    <img src="../img/jpgraph_logo.png" width="65" height="25" alt=""></a>
              <a href="http://www.fpdf.org">    <img src="../img/fpdfLogo.png" width="50" height="25" alt=""></a>
              <a href="https://startbootstrap.com">    <img src="../img/startboostrap.png" width="70" height="25" alt=""></a>
            </a>
        </li>
    </ul>