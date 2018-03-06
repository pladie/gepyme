<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
	<link href="../css/gepyme.css" rel="stylesheet" type="text/css">
</head>
 
<body class="body">
    <div align="center">
    	<h3>Ver detalle de un Bien</h3>
    	<table class="table">
	    	<thead>
            <tr>
               <th>Asignacion</th><th>Tipo</th><th>Marca</th><th>Modelo</th><th>Serie</th>
            </tr>
         </thead>
         <tbody>
    		<?php
    			include '../database.php';
    			$pdo = Database::connect();
    			$sql = 'SELECT * FROM stock WHERE stkestado = "ASIGNADO" ORDER BY stkasignacion';
				foreach ($pdo->query($sql) as $row) {
               echo '<tr>';
               echo '<td>'. $row['stkasignacion'] . '</td>';
               echo '<td>'. $row['stktipo'] . '</td>';
               echo '<td>'. $row['stkmarca'] . '</td>';
               echo '<td>'. $row['stkmodelo'] . '</td>';
               echo '<td>'. $row['stkserie'] . '</td>';               
					echo '</tr> ';
               }
            Database::disconnect();
         ?>
         </tbody>
		</table>
		<br>
		<a href="menuStock.php">Volver</a>
    </div>
</body>
</html>
