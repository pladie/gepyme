<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link href="../css/gepyme.css" rel="stylesheet" type="text/css">
</head>
<body class="body">
   <div align="center">
      <p class="title"><strong>Modificaion de Proveedore</strong></p>
         <table class="tableli">
            <thead>
               <tr>
                  <th>Proveedor</th><th>Estado</th><th>Detalle</th><th>Editar</th><th>Borrar</th>
               </tr>
            </thead>
            <tbody>
            <?php
	            include '../database.php';
               $pdo = Database::connect();
               $sql = 'SELECT * FROM proveedores WHERE provestado != "BAJA" ORDER BY provnombre';      
               foreach ($pdo->query($sql) as $row) {
                  echo '<tr>';
                  echo '<td>'. $row['provnombre'] . '</td>';
                  echo '<td>'. $row['provestado'] . '</td>';
                  echo '<td align="center">';
                  echo '<a href="verProv.php?id='.$row['provid'].'">';
                  echo '<img alt="" src="../img/eye.png" width="15" height="15"></a>';
    					echo '</td> ';
        				echo '<td align="center">';
                  echo '<a href="modProv.php?id='.$row['provid'].'">';
                  echo '<img alt="" src="../img/pencil.png" width="15" height="15"></a>';
                  echo '</td> ';
        				echo '<td align="center">';
                  echo '<a href="bajaProv.php?id='.$row['provid'].'">';
                  echo '<img alt="" src="../img/cancel.png" width="15" height="15"></a>';
                  echo '</td>';
                  echo '</tr>';
               }
             Database::disconnect();
             ?>
         </tbody>
       </table>
       <br>	
       <div class="volver">
			<a href="./menuAdm.php" target="content">Volver</a>
		 </div>
    </div>
  </body>
</html>