<?php // content="text/plain; charset=utf-8"
require_once ('../jpgraph/jpgraph.php');
require_once ('../jpgraph/jpgraph_pie.php');
require_once ('../jpgraph/jpgraph_pie3d.php');

include '../database.php';
//---------------------------------Lineas por Proyecto
$pdo = Database::connect();

//Busco datos por proyecto
$sql = 'SELECT
(SELECT count(*) FROM gepyme.stock WHERE stktipo = "Linea" and stkestado != "BAJA" and stkproyecto = "CH1") as ch1,
(SELECT count(*) FROM gepyme.stock WHERE stktipo = "Linea" and stkestado != "BAJA" and stkproyecto = "CH2") as ch2,
(SELECT count(*) FROM gepyme.stock WHERE stktipo = "Linea" and stkestado != "BAJA" and stkproyecto = "SMS") as sms,
(SELECT count(*) FROM gepyme.stock WHERE stktipo = "Linea" and stkestado != "BAJA" and stkproyecto = "VOZ") as voz,
(SELECT count(*) FROM gepyme.stock WHERE stktipo = "Linea" and stkestado != "BAJA" and stkproyecto = "SFE") as sfe,
(SELECT count(*) FROM gepyme.stock WHERE stktipo = "Linea" and stkestado != "BAJA" and stkproyecto = "INET") as ine';

$q = $pdo->prepare($sql);
$q->execute();
$data  = $q->fetch(PDO::FETCH_ASSOC);
$ch1 = $data['ch1'];
$ch2 = $data['ch2'];
$sms = $data['sms'];
$voz = $data['voz'];
$sfe = $data['sfe'];
$ine = $data['ine'];

Database::disconnect();

$data = array($ch1,$ch2,$sms,$voz,$sfe,$ine);

$graph = new PieGraph(450,250);
$graph->SetShadow();

// Set A title for the plot 
$graph->title->Set("Lineas por Proyecto");
$graph->title->SetFont(FF_FONT1,FS_BOLD);

// Create pie plot 
$p1 = new PiePlot3D($data);
$p1->SetAngle(40);
$p1->SetSize(0.5);
$p1->SetCenter(0.5);

// Setup the labels
$p1->SetLabelType(PIE_VALUE_PER);    
$p1->value->Show();            
$p1->value->SetFont(FF_ARIAL,FS_NORMAL,9);    
$p1->value->SetFormat('%2.1f%%');

// Adjust the legend position
$p1->SetLegends(array('ATX','Lugalu','SMS','VOZ','SFE','INET'));
$graph->legend->SetLayout(LEGEND_HOR);
$graph->legend->Pos(0.49,0.95,"center","bottom");
 
$graph->Add($p1);
$gdImgHandler = $graph->Stroke(_IMG_HANDLER);
//$graph->Stroke();
$fileName = "../img/zLinPorProd.png";
$graph->img->Stream($fileName);

//---------------------------------Lineas por Empresa
$pdo = Database::connect();

//Busco datos por empresa
$sql = 'SELECT
(SELECT count(*) FROM gepyme.stock WHERE stkmarca = "Claro-ATX"       and stkestado != "BAJA") as Cla,
(SELECT count(*) FROM gepyme.stock WHERE stkmarca = "Movistar-Lugalu" and stkestado != "BAJA") as Mov,
(SELECT count(*) FROM gepyme.stock WHERE stkmarca = "Personal-Lugalu" and stkestado != "BAJA") as Per';

$q = $pdo->prepare($sql);
$q->execute();
$data  = $q->fetch(PDO::FETCH_ASSOC);
$Cla = $data['Cla'];
$Mov = $data['Mov'];
$Per = $data['Per'];

Database::disconnect();

$data = array($Cla,$Mov,$Per);

$graph = new PieGraph(370,250);
$graph->SetShadow();

// Set A title for the plot 
$graph->title->Set("Lineas por Empresa");
$graph->title->SetFont(FF_FONT1,FS_BOLD);

// Create pie plot 
$p1 = new PiePlot3D($data);
$p1->SetAngle(40);
$p1->SetSize(0.5);
$p1->SetCenter(0.5);

// Adjust the legend position
$p1->SetLegends(array('Claro','Movistar','Personal'));
$graph->legend->SetLayout(LEGEND_HOR);
$graph->legend->Pos(0.49,0.95,"center","bottom");
 
$graph->Add($p1);
$gdImgHandler = $graph->Stroke(_IMG_HANDLER);
//$graph->Stroke();
$fileName = "../img/zLinPorEmp.png";
$graph->img->Stream($fileName);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<link href="../css/gepyme.css" rel="stylesheet" type="text/css">
</head>
<body class="body">
<div align="left" class="volver">
   	<a href="menuPanel.php">Volver</a>
</div>
<div align="center">
	<p class="title"><strong>Distribucion y Estado de las Lineas</strong></p>
	<table>
		<tr align="center">
			<td>
				<img src="../img/zLinPorProd.png" width="450" height="250" alt="">
			</td>
		</tr>
	</table>
	<table>
		<tr align="center">
			<td>
				<a href="menuPanel.php"><img src="../img/zLinPorEmp.png" width="370" height="250" alt=""></a>
			</td>
		</tr>
	</table>
</div>
</body>	
</html>
