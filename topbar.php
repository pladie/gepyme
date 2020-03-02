<?php
  session_start();

  require_once '../database.php';
  $pdo = Database::connect();

  // Cuento cantidad de alarmas
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT count(*) AS canal FROM solicitudes WHERE solTipo = ?";
  $q = $pdo->prepare($sql);
  $q->execute(array(1));
  $data  = $q->fetch(PDO::FETCH_ASSOC);
  $cantalarm = $data['canal'];

  Database::disconnect();
?>
        
        <!-- Topbar ----------------------------------------------------------------------------------------->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -------------------------------------------------------------------------------->
          <ul class="navbar-nav ml-auto">

            <!-- Notificaciones de Alertas -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Contador de Alertas -->
                <?php if ($cantalarm > 0) echo '<span class="badge badge-danger badge-counter">' . $cantalarm . '</span>';?>
              </a>
              <!-- Muestro las alarmas si hay -->
              <?php if ($cantalarm > 0) {
                echo '<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">';
                echo '  <h6 class="dropdown-header">Alertas</h6>';
                echo '  <a class="dropdown-item d-flex align-items-center" href="#">';
                echo '    <div class="mr-3">';
                echo '      <div class="icon-circle bg-primary">';
                echo '        <i class="fas fa-file-alt text-white"></i>';
                echo '      </div>';
                echo '    </div>';
                echo '    <div>';
                echo '      <div class="small text-gray-500"><?php echo date("d/m/Y");?></div>';
                echo '      <span class="font-weight-bold">Hay ' . $cantalarm . ' solicitudes de compra sin procesar.</span>';
                echo '    </div>';
                echo '  </a>';
                echo '</div>';
                }
              ?>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username'];?></span>
              </a>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar ------------------------------------------------------------------------------------------->
