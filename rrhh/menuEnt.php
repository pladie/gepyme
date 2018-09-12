<?php
	include '../database.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title>ABM - Entrevistas</title>
	<link href="../css/gepyme.css" rel="stylesheet" type="text/css">
</head>
<body class="body"> 
<div align="center">
		<p><strong>Gestion de Recursos Humanos</strong></p>
		<a target="content" href="./altaEnt.php">Agendar Entrevista</a><br>
		<a target="content" href="./bmEnt.php">Modificar Entrevista</a><br>
	</div>
</div>
<br><br>
<div id="abmUsuario" align="center">
<p><strong>A G E N D A</strong></p>
<table class="table" >
		<thead><tr><th>Nombre</th><th>Dia</th><th>Hora</th><th>Nota</th><th>Entrevistar</th></thead>
		<tbody>
		<?php
			$pdo = Database::connect();
   		$sql = 'SELECT * FROM personas ORDER BY pernombre'; 
			foreach ($pdo->query($sql) as $row) {
           	echo '<tr>';
            echo '<td>'. $row['pernombre'] . '</td>';
		 		echo '<td align="center">';
				echo '<a href="doEnt.php?id='.$row['perid'].'">';
				echo '<img alt="" src="../img/list.png" width="15" height="15"></a>';
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
