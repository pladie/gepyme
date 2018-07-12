<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link href="../css/gepyme.css" rel="stylesheet" type="text/css">
</head>
<body class="body">
    <div align="center">
            <div class="row">
            	<p class="title"><strong>Modificaion de Personas</strong>
            </div>
            <div class="row">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Nombre</th><th>DNI</th><th>Estado</th><th>Proyecto</th><th>Fecha Alta</th><th>Fecha Baja</th><th>Detalle</th><th>Editar</th><th>Borrar</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include '../database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM personas WHERE perestado != "BAJA" and pernombre != "STOCK" ORDER BY pernombre';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['pernombre'] . '</td>';
                            echo '<td>'. $row['perdni'] . '</td>';
                            echo '<td>'. $row['perestado'] . '</td>';
                            echo '<td>'. $row['perasig'] . '</td>';
                            echo '<td>'. $row['perfecalta'] . '</td>';
                            echo '<td>'. $row['perfecbaja'] . '</td>';
                            echo '<td align="center">';
                            echo '<a href="verPer.php?id='.$row['perid'].'">';
                            echo '<img alt="" src="../img/eye.png" width="15" height="15"></a>';
        							 echo '</td> ';
        							 echo '<td align="center">';
                            echo '<a href="modPer.php?id='.$row['perid'].'">';
                            echo '<img alt="" src="../img/pencil.png" width="15" height="15"></a>';
                            echo '</td> ';
        							 echo '<td align="center">';
                            echo '<a href="baja.php?id='.$row['perid'].'">';
                            echo '<img alt="" src="../img/cancel.png" width="15" height="15"></a>';
                            echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
        <br>
   <div class="volver">
		<a href="./menuRRHH.php" target="content">Volver</a>
	</div>
    </div> <!-- /container -->
  </body>
</html>
