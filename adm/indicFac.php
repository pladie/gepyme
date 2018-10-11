<?php
	include '../database.php';
	
	$pdo = Database::connect();
	
	$sqlA = "DELETE from factemp;";
	$sqlB = "INSERT factemp ( SELECT provnombre,NULL,NULL,NULL,NULL FROM proveedores WHERE provestado != 'BAJA' AND protipo = 0 ORDER BY 1);";
	
	$sqlC = "UPDATE factemp,( SELECT facproveedor,round(sum(evAdmin + evAprod)/2,2) AS 'Indicador'
										 FROM ( SELECT facproveedor,
															round(avg(case facevaladmin
															when 'Malo'      then 1
															when 'Regular'   then 2
															when 'Bueno'     then 3
															when 'Excelente' then 4
														else 0 end)) AS evAdmin,
														round(avg(case facevalprod
															when 'Malo'      then 1
															when 'Regular'   then 2
															when 'Bueno'     then 3
															when 'Excelente' then 4
														else 0 end)) AS evAprod
													FROM facturas
												  WHERE facproveedor IN (SELECT provnombre FROM proveedores WHERE provestado != 'BAJA' AND protipo = 0 ORDER BY 1)
													 AND facfecha BETWEEN '2018-01-01' AND '2018-03-31' 
												  GROUP BY 1
												) AS tbl1 GROUP BY 1
									) AS tbl2
					SET EneMar = case Indicador
										when '1.00' then 'Malo'
										when '2.00' then 'Regular'
										when '2.50' then 'Regular'
										when '2.75' then 'Regular'
										when '3.00' then 'Bueno'
										when '4.00' then 'Excelente'
									 else 'N/A' end
				 WHERE factemp.facproveedor = tbl2.facproveedor;commit;";

	$sqlD = "UPDATE factemp,( SELECT facproveedor,round(sum(evAdmin + evAprod)/2,2) AS 'Indicador'
										 FROM ( SELECT facproveedor,
															round(avg(case facevaladmin
															when 'Malo'      then 1
															when 'Regular'   then 2
															when 'Bueno'     then 3
															when 'Excelente' then 4
														else 0 end)) AS evAdmin,
														round(avg(case facevalprod
															when 'Malo'      then 1
															when 'Regular'   then 2
															when 'Bueno'     then 3
															when 'Excelente' then 4
														else 0 end)) AS evAprod
													FROM facturas
													WHERE facproveedor IN (SELECT provnombre FROM proveedores WHERE provestado != 'BAJA' AND protipo = 0 ORDER BY 1)
													AND facfecha BETWEEN '2018-04-01' and '2018-06-30' 
													GROUP BY 1
												) AS tbl1 GROUP BY 1
									) AS tbl2
					SET AbrJun = case Indicador
										when '1.00' then 'Malo'
										when '2.00' then 'Regular'
										when '2.50' then 'Regular'
										when '2.75' then 'Regular'
										when '3.00' then 'Bueno'
										when '4.00' then 'Excelente'
									 else 'N/A' end
				 WHERE factemp.facproveedor = tbl2.facproveedor;";
				 
	$sqlE = "UPDATE factemp,( SELECT facproveedor,round(sum(evAdmin + evAprod)/2,2) AS 'Indicador'
										 FROM ( SELECT facproveedor,
															round(avg(case facevaladmin
															when 'Malo'      then 1
															when 'Regular'   then 2
															when 'Bueno'     then 3
															when 'Excelente' then 4
														else 0 end)) AS evAdmin,
														round(avg(case facevalprod
															when 'Malo'      then 1
															when 'Regular'   then 2
															when 'Bueno'     then 3
															when 'Excelente' then 4
														else 0 end)) AS evAprod
													FROM facturas
													WHERE facproveedor IN (SELECT provnombre FROM proveedores WHERE provestado != 'BAJA' AND protipo = 0 ORDER BY 1)
													AND facfecha BETWEEN '2018-07-01' and '2018-09-30' 
													GROUP BY 1
												) AS tbl1 GROUP BY 1
									) AS tbl2
					SET JulSep = case Indicador
										when '1.00' then 'Malo'
										when '2.00' then 'Regular'
										when '2.50' then 'Regular'
										when '2.75' then 'Regular'
										when '3.00' then 'Bueno'
										when '4.00' then 'Excelente'
									 else 'N/A' end
				 WHERE factemp.facproveedor = tbl2.facproveedor;";
				 
	$sqlF = "UPDATE factemp,( SELECT facproveedor,round(sum(evAdmin + evAprod)/2,2) AS 'Indicador'
										 FROM ( SELECT facproveedor,
															round(avg(case facevaladmin
															when 'Malo'      then 1
															when 'Regular'   then 2
															when 'Bueno'     then 3
															when 'Excelente' then 4
														else 0 end)) AS evAdmin,
														round(avg(case facevalprod
															when 'Malo'      then 1
															when 'Regular'   then 2
															when 'Bueno'     then 3
															when 'Excelente' then 4
														else 0 end)) AS evAprod
													FROM facturas
													WHERE facproveedor IN (SELECT provnombre FROM proveedores WHERE provestado != 'BAJA' AND protipo = 0 ORDER BY 1)
													AND facfecha BETWEEN '2018-10-01' and '2018-12-31'
													GROUP BY 1
												) AS tbl1 GROUP BY 1
									) AS tbl2
					SET OctDic = case Indicador
										when '1.00' then 'Malo'
										when '2.00' then 'Regular'
										when '2.50' then 'Regular'
										when '2.75' then 'Regular'
										when '3.00' then 'Bueno'
										when '4.00' then 'Excelente'
									 else 'N/A' end
				 WHERE factemp.facproveedor = tbl2.facproveedor;";
	
	$pdo->query($sqlA);
	$pdo->query($sqlB);
	$pdo->query($sqlC);
	$pdo->query($sqlD);
	$pdo->query($sqlE);
	$pdo->query($sqlF);
	
	$sql1 = "SELECT * FROM factemp;";
/*	
	$sql = "SELECT  facproveedor,
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
						  WHERE facproveedor IN (SELECT provnombre FROM proveedores WHERE provestado != 'BAJA' AND protipo = 0 ORDER BY 1)
						    AND facfecha BETWEEN '2018-10-01' AND '2018-12-31'
					  GROUP BY 1
				) tbl1 GROUP BY 1;";
		*/		
	Database::disconnect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
	<link href="../css/gepyme.css" rel="stylesheet" type="text/css">
</head>
 
<body class="body">
	<div align="left" class="volver">
		<a href="./menuAdm.php" target="content">Volver</a>
	</div>
	<div align="center">
		<p class="title"><strong>Evaluaciones Anteriores</strong></p>
		<table class="tableli" >
      	<thead>
      		<tr><th>Proveedor</th><th>EneMar</th><th>AbrJun</th><th>JulSep</th><th>OctDic</th></tr>
      	</thead>
			<tbody>
				<?php
					foreach ($pdo->query($sql1) as $row) {
	               echo '<tr>';
                  echo '<td>'. $row['facproveedor'] . '</td>';
                  echo '<td>'. $row['EneMar'] . '</td>';
                  echo '<td>'. $row['AbrJun'] . '</td>';
                  echo '<td>'. $row['JulSep'] . '</td>';
                  echo '<td>'. $row['OctDic'] . '</td>';
                  echo '</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
<!--	
	<div align="center">
		<p class="title"><strong>Evaluacion Actual</strong></p>
		<table class="tableli" >
      	<thead>
      		<tr><th>Proveedor</th><th>Prom. Ev. Admin.</th><th>Prom. Ev. Prod./Serv.</th><th>Indicador</th><th>Minimo Req.</th><th>Desempeño</th></tr>
      	</thead>
			<tbody>
				<?php
					foreach ($pdo->query($sql) as $row) {
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
  -->  
  </body>
</html>
