<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link href="../css/gepyme.css" rel="stylesheet" type="text/css">
</head>
<body class="body">
	<div align="center">
		<p class="title"><strong>Modificaion de Facturas</strong></p>
      <table class="tabla">
      	<thead><tr>
            <th>Factura</th><th>Fecha</th><th>Proveedor</th><th>Importe</th><th>Ev. Admin.</th><th>Ev. Prod./Serv.</th><th>Detalle</th><th>Editar</th><th>Borrar</th>
         </tr></thead>
         <tbody>
         	<?php
            include '../database.php';
            $pdo = Database::connect();
            $sql = 'SELECT * FROM facturas ORDER BY facid';      
            foreach ($pdo->query($sql) as $row) {
            	echo '<tr>';
               echo '<td>'. $row['facnro'] . '</td>';
               echo '<td>'. $row['facfecha'] . '</td>';
               echo '<td>'. $row['facproveedor'] . '</td>';
               echo '<td>'. $row['facimporte'] . '</td>';
               echo '<td>'. $row['facevaladmin'] . '</td>';
               echo '<td>'. $row['facevalprod'] . '</td>';
               echo '<td align="center">';
               echo '<a href="verFac.php?id='.$row['facid'].'">';
               echo '<img alt="" src="../img/eye.png" width="15" height="15"></a>';
        			echo '</td> ';
        			echo '<td align="center">';
               echo '<a href="modFac.php?id='.$row['facid'].'">';
               echo '<img alt="" src="../img/pencil.png" width="15" height="15"></a>';
               echo '</td> ';
        			echo '<td align="center">';
               echo '<a href="bajaFac.php?id='.$row['facid'].'">';
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
		<a href="./menuAdm.php" target="content">Volver</a>
	</div>
</body></html>