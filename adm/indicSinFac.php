<?php
	include '../database.php';
	
	$pdo = Database::connect();
	
	$sqlA = "delete from factemp;";
	$sqlB = "insert factemp (SELECT provnombre,NULL,NULL,NULL,NULL FROM proveedores WHERE provestado != 'BAJA' AND protipo = 1 group BY 1);";
	$sqlC = "update factemp, facturas set EneMar = facevalprod where facturas.facproveedor = factemp.facproveedor AND facfecha between '2018-01-01' and '2018-03-31';";
	$sqlD = "update factemp, facturas set AbrJun = facevalprod where facturas.facproveedor = factemp.facproveedor AND facfecha between '2018-04-01' and '2018-06-30';";
	$sqlE = "update factemp, facturas set JulSep = facevalprod where facturas.facproveedor = factemp.facproveedor AND facfecha between '2018-07-01' and '2018-09-30';";
	$sqlF = "update factemp, facturas set OctDic = facevalprod where facturas.facproveedor = factemp.facproveedor AND facfecha between '2018-10-01' and '2018-12-31';";

	$pdo->query($sqlA);
	$pdo->query($sqlB);
	$pdo->query($sqlC);
	$pdo->query($sqlD);
	$pdo->query($sqlE);
	$pdo->query($sqlF);
	
	$sql1 = "SELECT * FROM factemp;";
//	$sql2 = "SELECT facproveedor,OctDic FROM factemp;";

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
		<p class="title"><strong>Evaluaci&oacuten Actual</strong></p>
		<table class="tableli" >
      	<thead>
      		<tr><th>Proveedor</th><th>Evaluaci&oacuten Prod./Serv.</th></tr>
      	</thead>
			<tbody>
				<?php
					foreach ($pdo->query($sql2) as $row) {
	               echo '<tr>';
                  echo '<td>'. $row['facproveedor'] . '</td>';
                  echo '<td>'. $row['OctDic'] . '</td>';
                  echo '</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
	-->
</body>
</html>
