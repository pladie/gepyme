<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link href="../css/gepyme.css" rel="stylesheet" type="text/css">
</head>
<body class="body">
    <div align="center">
            <div class="row">
                <h3>Modificaion de Monitores</h3>
            </div>
            <div class="row">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Marca</th><th>Modelo</th><th>Serie</th><th>Asignacion</th><th>Detalle</th><th>Asignar</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include '../database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM stock WHERE stktipo = "Monitor" and stkasignacion = "STOCK" ORDER BY stkmarca,stkmodelo';      
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['stkmarca'] . '</td>';
                            echo '<td>'. $row['stkmodelo'] . '</td>';
                            echo '<td>'. $row['stkserie'] . '</td>';
                            echo '<td>'. $row['stkasignacion'] . '</td>';
                            echo '<td align="center">';
                            echo '<a href="verBien.php?id='.$row['stkid'].'">';
                            echo '<img alt="" src="../img/eye.png" width="15" height="15"></a>';
        							 echo '</td> ';
        							 echo '<td align="center">';
                            echo '<a href="modMon.php?id='.$row['stkid'].'">';
                            echo '<img alt="" src="../img/pencil.png" width="15" height="15"></a>';
                            echo '</td> ';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>
