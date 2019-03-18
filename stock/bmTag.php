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
		<p class="title"><strong>Modificaion de Dispositivos</strong></p>
     	<table class="tableli">
         <thead>
            <tr><th>Modelo</th><th>Serie</th><th>Asignacion</th><th>Detalle</th><th>Asignar</th></tr>
         </thead>
         <tbody>
            <?php
               include '../database.php';
               $pdo = Database::connect();
               $sql = 'SELECT * FROM stock WHERE stktipo = "Tag" and stkasignacion = "STOCK" AND stkestado NOT IN ("BAJA") ORDER BY stkmodelo';      
               foreach ($pdo->query($sql) as $row) 
               {
                  echo '<tr>';
                  echo '<td>'. $row['stkmodelo'] . '</td>';
                  echo '<td>'. $row['stkserie'] . '</td>';
                  echo '<td>'. $row['stkasignacion'] . '</td>';
                  echo '<td align="center">';
                  echo '<a href="verBien.php?id='.$row['stkid'].'">';
                  echo '<img alt="" src="../img/eye.png" width="15" height="15"></a>';
 						echo '</td> ';
        				echo '<td align="center">';
                  echo '<a href="modTag.php?id='.$row['stkid'].'">';
                  echo '<img alt="" src="../img/pencil.png" width="15" height="15"></a>';
                  echo '</td> ';
                  echo '</tr>';
               }
               Database::disconnect();
            ?>
         </tbody>
      </table>
   </div>
</body>
</html>