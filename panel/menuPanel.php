<?php // content="text/plain; charset=utf-8"
require_once ('../jpgraph/jpgraph.php');
require_once ('../jpgraph/jpgraph_bar.php');
 
$datay1=array(37,4);				//Asignados
$datay2=array(13,2);				//Disponibles
$datax1=array("Claro","Personal");

// Create the graph.
$graph = new Graph(370,250);
$graph->SetScale('textlin');
$graph->img->SetMargin(50,150,40,50);   //Tamaño del grafico dentro del marco
$graph->SetMarginColor('white');
$graph->legend->Pos(0.01,0.5,"right","center"); //Posicion de la caja de leyendas

// Setup title
$graph->title->Set('SIMs');
//$graph->subtitle->Set('(With "hidden" y-axis)');
$graph->xaxis->title->Set("Proveedores");
$graph->yaxis->title->Set("Cantidad");
$graph->xaxis->SetTickLabels($datax1);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8);
//$graph->xaxis->SetLabelAngle(45);			// Pone los titulos del eje X a 45 

//$graph->title->SetFont(FF_FONT1,FS_BOLD);
//$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
//$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

//$graph->ygrid->Show(false);
//$graph->ygrid->SetColor('white@0.5');

// Create the first bar
$bplot = new BarPlot($datay1);
$bplot->SetFillGradient('AntiqueWhite2','AntiqueWhite4:0.8',GRAD_VERT);
$bplot->SetColor('darkred');
$bplot->SetWeight(0);
$bplot->SetLegend("Asingadas");
$bplot->value->Show();
$bplot->value->SetColor('white');

// Create the second bar
$bplot2 = new BarPlot($datay2);
$bplot2->SetFillGradient('olivedrab1','olivedrab4',GRAD_VERT);
$bplot2->SetColor('darkgreen');
$bplot2->SetWeight(0);
$bplot2->SetLegend("Disponibles");
$bplot2->value->Show();
$bplot2->value->SetColor('white');

// And join them in an accumulated bar
$accbplot = new AccBarPlot(array($bplot,$bplot2));
$accbplot->SetColor('darkgray');
$accbplot->SetWeight(1);
$graph->Add($accbplot);

//$graph->Stroke();
$gdImgHandler = $graph->Stroke(_IMG_HANDLER);
$fileName = "../img/zSimcards.png";
$graph->img->Stream($fileName);
//$graph->img->Headers();
//$graph->img->Stream();
//---------------------------------------------------------
// Histograma

// content="text/plain; charset=utf-8"
//
// Basic example on how to use custom tickmark feature to have a label
// at the start of each month.
//
require_once ('../jpgraph/jpgraph_line.php');

$labels = array("Oct","Nov","Dec","Jan","Feb","Mar","Apr","May");
$datay = array(1.23,1.9,1.6,3.1,3.4,2.8,2.1,1.9);
$graph = new Graph(300,200);
$graph->img->SetMargin(50,40,40,50);    
$graph->img->SetAntiAliasing();
$graph->SetScale("textlin");
//$graph->SetShadow();
$graph->title->Set("Histograma");
$graph->title->SetFont(FF_ARIAL,FS_NORMAL,12);

$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8);
$graph->xaxis->SetTickLabels($labels);
//$graph->xaxis->SetLabelAngle(45);

$p1 = new LinePlot($datay);
//$p1->mark->SetType(MARK_FILLEDCIRCLE);
//$p1->mark->SetFillColor("red");
//$p1->mark->SetWidth(4);
$p1->SetColor("blue");
//$p1->SetCenter();
$graph->Add($p1);

$gdImgHandler = $graph->Stroke(_IMG_HANDLER);
$fileName = "../img/zHistograma.png";
$graph->img->Stream($fileName);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<link href="../css/gepyme.css" rel="stylesheet" type="text/css">
</head>
<body class="body">
<div align="center">
	<p class="title"><strong>Tablero de control</strong></p>
	<table>
		<tr align="center">
			<td>
				<table>
					<tr><td>
						<img src="../img/zSimcards.png" width="370" height="250" alt="">
					</td></tr>
				</table>
			</td>
			<td>
				<table>
					<tr><td>
						<img src="../img/zSimcards.png" width="370" height="250" alt="">
					</td></tr>
				</table>
			</td>
		</tr>
	</table>
	<table>
		<tr align="center">
			<td>
				<img src="../img/zSimcards.png" width="370" height="250" alt="">
			</td>
		</tr>
	</table>
	<table>
		<tr align="center">
			<td>
				<img src="../img/zHistograma.png" width="300" height="200" alt="">
			</td>
		</tr>
	</table>
	<table>
		<tr>
			<td>
				<ul class="ulint">
					<li class="liint"><a target="content" href="./distLineas.php">Distribucion de Lineas</a></li>
				</ul>
			</td>
		</tr>
	</table>
</div>
</body>	
</html>

