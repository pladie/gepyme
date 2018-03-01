<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
	<link href="../css/gepyme.css" rel="stylesheet" type="text/css">
</head>
 
<body class="body">
	<div align="center">
		<h3>Indicador de Compras</h3>
		<table class="table" >
      	<thead>
      		<tr><th>Proveedor</th><th>Prom. Ev. Admin.</th><th>Prom. Ev. Prod./Serv.</th></tr>
      	</thead>
			<tbody>
				<?php
					include '../database.php';
					$pdo = Database::connect();
					$sql = "SELECT facproveedor, avg(case facevaladmin
								WHEN 'Malo'      then 1
								WHEN 'Regular'   then 2
								WHEN 'Bueno'     then 3
								WHEN 'Excelente' then 4 else 0 end) as evAdmin,
								avg(case facevalprod
								WHEN 'Malo'      then 1
								WHEN 'Regular'   then 2
								WHEN 'Bueno'     then 3
								WHEN 'Excelente' then 4 else 0 end) as evAprod
							  FROM facturas GROUP BY 1;";
					foreach ($pdo->query($sql) as $row) {
	               echo '<tr>';
                  echo '<td>'. $row['facproveedor'] . '</td>';
                  echo '<td>'. $row['evAdmin'] . '</td>';
                  echo '<td>'. $row['evAprod'] . '</td>';
                  echo '</tr>';
					}
					Database::disconnect();
				?>
			</tbody>
		</table>
   </div>
  </body>
</html>
