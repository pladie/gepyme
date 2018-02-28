<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link href="../css/gepyme.css" rel="stylesheet" type="text/css">
</head>
<body class="body">
    <div align="center">
            <div class="row">
                <h3>Modificaion de Bienes</h3>
            </div>
            <div class="row">
                           <!-- facnro, facfecha, facproveedor, facimporte, facevaladmin, facevalprod -->  
                <table class="table">
                  <thead>
                    <tr>
                      <th>Marca</th><th>Modelo</th><th>Numero</th><th>Plan</th><th>Asignacion</th><th>Detalle</th><th>Asignar</th><th>Comprobante</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM stock WHERE stktipo = "Linea" and stkasignacion = "STOCK" ORDER BY stkserie';      
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['stkmarca'] . '</td>';
                            echo '<td>'. $row['stkmodelo'] . '</td>';
                            echo '<td>'. $row['stkserie'] . '</td>';
                            echo '<td>'. $row['stkplan'] . '</td>';
                            echo '<td>'. $row['stkasignacion'] . '</td>';
                            echo '<td align="center">';
                            echo '<a href="verBien.php?id='.$row['iduser'].'">';
                            echo '<img alt="" src="../img/eye.png" width="15" height="15"></a>';
        							 echo '</td> ';
        							 echo '<td align="center">';
                            echo '<a href="modLin.php?id='.$row['iduser'].'">';
                            echo '<img alt="" src="../img/pencil.png" width="15" height="15"></a>';
                            echo '</td> ';
        							 echo '<td align="center">';
                            echo '<a href="pdfBien.php?nombre='.$row['stkasignacion'].'&tipo='.$row['stktipo'].'&marca='.$row['stkmarca'].'&modelo='.$row['stkmodelo'].'&serie='.$row['stkserie'].'">';
                            echo '<img alt="" src="../img/cancel.png" width="15" height="15"></a>';
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