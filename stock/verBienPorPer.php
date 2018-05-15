<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
	<link href="../css/gepyme.css" rel="stylesheet" type="text/css">
</head>
 
<body class="body">
   <div align="center">
   	<p class="title"><strong>Listado de Bienes por Persona</strong>
    	<table class="tableli">
	    	<thead>
            <tr><th>Asignacion</th><th>Tipo</th><th>Marca</th><th>Modelo</th><th>Serie</th><th>Plan</th></tr>
         </thead>
         <tbody>
    			<?php
    				include '../database.php';
    				$pdo = Database::connect();
    				$sql = 'SELECT * FROM stock WHERE stkasignacion NOT IN ("BAJA","STOCK") ORDER BY stkasignacion';
					foreach ($pdo->query($sql) as $row) {
               	echo '<tr>';
               	echo '<td>'. $row['stkasignacion'] . '</td>';
               	echo '<td>'. $row['stktipo'] . '</td>';
               	echo '<td>'. $row['stkmarca'] . '</td>';
               	echo '<td>'. $row['stkmodelo'] . '</td>';
               	echo '<td>'. $row['stkserie'] . '</td>';
               	echo '<td>'. $row['stkplan'] . '</td>';               
						echo '</tr> ';
               }
            	Database::disconnect();
         	?>
         </tbody>
		</table>
		<br>
		<div class="volver">
			<a href="menuStock.php">Volver</a>
		</div>
    </div>
</body>
</html>
