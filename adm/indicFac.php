<?php
	include '../database.php';
	$pdo  = Database::connect();
	$sql1 = "SELECT  facproveedor,
						  round(sum(evAdmin + evAprod)/2,2) as 'Indicador'
				  FROM (
					 	  SELECT facproveedor, 
						 			round(avg(case facevaladmin
								 				 when 'Malo'      then 1
								 				 when 'Regular'   then 2
								 				 when 'Bueno'     then 3
								 				 when 'Excelente' then 4
								 				 else 0 end)) as evAdmin,
								 	round(avg(case facevalprod
								 				 when 'Malo'      then 1
								 		 		 when 'Regular'   then 2
								 		 		 when 'Bueno'     then 3
								 		 		 when 'Excelente' then 4
								 		 		 else 0 end)) as evAprod
							 FROM facturas 
							WHERE facproveedor IN ( SELECT provnombre FROM proveedores WHERE provestado != 'BAJA' AND protipo = 0 ORDER BY provnombre) 
							GROUP BY 1
						  ) tbl1 group by 1;";
	$sql2 = "SELECT  facproveedor,
						  evAdmin,
						  evAprod,
						  round(sum(evAdmin + evAprod)/2,2) as 'Indicador',
						  '75' as 'Min',
						  round(sum(((evAdmin/3)*.3) + ((evAprod/3)*.7))*100,2) as 'Desemp'
				  FROM (
					 	  SELECT facproveedor, 
						 			round(avg(case facevaladmin
								 				 when 'Malo'      then 1
								 				 when 'Regular'   then 2
								 				 when 'Bueno'     then 3
								 				 when 'Excelente' then 4
								 				 else 0 end)) as evAdmin,
								 	round(avg(case facevalprod
								 				 when 'Malo'      then 1
								 		 		 when 'Regular'   then 2
								 		 		 when 'Bueno'     then 3
								 		 		 when 'Excelente' then 4
								 		 		 else 0 end)) as evAprod
							 FROM facturas 
							WHERE facproveedor IN ( SELECT provnombre FROM proveedores WHERE provestado != 'BAJA' AND protipo = 0 ORDER BY provnombre) 
							GROUP BY 1
						  ) tbl1 group by 1;";
	Database::disconnect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
	<link href="../css/gepyme.css" rel="stylesheet" type="text/css">
</head>
 
<body class="body">
	<div align="center">
		<p class="title"><strong>Evaluaciones Anteriores</strong></p>
		<table class="tableli" >
      	<thead>
      		<tr><th>Proveedor</th><th>Calificaci&oacuten</th></tr>
      	</thead>
			<tbody>
				<?php
					foreach ($pdo->query($sql1) as $row) {
	               echo '<tr>';
                  echo '<td>'. $row['facproveedor'] . '</td>';
                  echo '<td>'. $row['Indicador'] . '</td>';
                  echo '</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
	<div align="center">
		<p class="title"><strong>Evaluaci&oacuten Actual</strong></p>
		<table class="tableli" >
      	<thead>
      		<tr><th>Proveedor</th><th>Prom. Ev. Admin.</th><th>Prom. Ev. Prod./Serv.</th><th>Calificaci&oacuten</th><th>Minimo Req.</th><th>Desempeño</th></tr>
      	</thead>
			<tbody>
				<?php
					foreach ($pdo->query($sql2) as $row) {
	               echo '<tr>';
                  echo '<td>'. $row['facproveedor'] . '</td>';
                  echo '<td>'. $row['evAdmin'] . '</td>';
                  echo '<td>'. $row['evAprod'] . '</td>';
                  echo '<td>'. $row['Indicador'] . '</td>';
                  echo '<td>'. $row['Min'] . '</td>';
                  echo '<td>'. $row['Desemp'] . '</td>';
                  echo '</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
	<br>
	<div>
      <div class="volver">
			<a href="./menuAdm.php" target="content">Volver</a>
		</div>
	</div>
</body>
</html>
