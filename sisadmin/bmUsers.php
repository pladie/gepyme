<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link href="../css/gepyme.css" rel="stylesheet" type="text/css">
</head>
<body class="body">
	<div align="left" class="volver">
		<a href="./menuSisAdmin.php" target="content" align="left">Volver</a>
	</div>
    <div align="center">
    	<p class="title"><strong>Mantenimiento de Usuarios</strong>
    	<table class="tableli">

         <thead>
            <tr><th>Usuario</th><th>Email</th><th>Adm&Fin</th><th>RRHH</th><th>Stock</th><th>Panel</th><th>Super</th><th>Estado</th><th>Modificar</th></tr>
         </thead>
         <tbody>
         	<?php
         		include '../database.php';
               $pdo = Database::connect();
               $sql = 'SELECT * FROM users ORDER BY 2';
               foreach ($pdo->query($sql) as $row) {
               	echo '<tr>';
                  echo '<td>'. $row['usunombre'] . '</td>';
                  echo '<td>'. $row['usumail'] . '</td>';
                  echo '<td>'. $row['privA'] . '</td>';
                  echo '<td>'. $row['privR'] . '</td>';
                  echo '<td>'. $row['privS'] . '</td>';
                  echo '<td>'. $row['privP'] . '</td>';
                  echo '<td>'. $row['superuser'] . '</td>';
                  echo '<td>'. $row['usuestado'] . '</td>';
   					echo '<td align="center">';
                  echo '<a href="modUser.php?id='.$row['usuid'].'">';
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
