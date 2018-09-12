<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link href="../css/gepyme.css" rel="stylesheet" type="text/css">
</head>
<body class="body">
<div align="left" class="volver">
   	<a href="menuStock.php">Volver</a>
	</div>
    <div align="center">
            <p class="title"><strong>Reasignacion de Linea</strong>
            <div class="row">
                <table class="tableli">
                  <thead>
                    <tr>
                      <th>Marca</th><th>Modelo</th><th>Serie</th><th>Asignacion</th><th>Detalle</th><th>Editar</th><th>Comprobante</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include '../database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM stock WHERE stktipo = "Linea" and stkasignacion NOT IN ("STOCK","BAJA") ORDER BY stkmarca,stkmodelo';      
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
                            echo '<a href="modLin.php?id='.$row['stkid'].'">';
                            echo '<img alt="" src="../img/pencil.png" width="15" height="15"></a>';
                            echo '</td> ';
        							 echo '<td align="center">';
                            echo '<a href="pdfBien.php?nombre='.$row['stkasignacion'].'&tipo='.$row['stktipo'].'&marca='.$row['stkmarca'].'&modelo='.$row['stkmodelo'].'&serie='.$row['stkserie'].'">';
                            echo '<img alt="" src="../img/document-2.png" width="15" height="15"></a>';
                            echo '</td>';
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
