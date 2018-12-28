<?php // content="text/plain; charset=utf-8"
require_once ('../jpgraph/jpgraph.php');
require_once ('../jpgraph/jpgraph_bar.php');

// ----------- Grafico de Disponibles vs. Asignadas
$datay1=array(37,4);				//Asignados
$datay2=array(13,2);				//Disponibles
$datax1=array("Claro","Personal");

// Create the graph.
$graph = new Graph(370,250);
$graph->SetScale('textlin');
$graph->img->SetMargin(50,150,40,50);   //Tamano del grafico dentro del marco
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

// ----------- Grafico de Distribucion de Planes
require_once ('../jpgraph/jpgraph_pie.php');

$data = array(25,25,25,25);

// A new pie graph
$graph = new PieGraph(370,250);
$graph->clearTheme();
//$graph->SetShadow();

// Title setup
$graph->title->Set("Distribucion de Planes");
//$graph->title->SetFont(FF_FONT1,FS_BOLD);

// Setup the pie plot
$p1 = new PiePlot($data);

// Adjust size and position of plot
$p1->SetSize(0.35);
$p1->SetCenter(0.5,0.52);

// Setup slice labels and move them into the plot
//$p1->value->SetFont(FF_FONT1,FS_BOLD);
$p1->value->SetColor("darkred");
$p1->SetLabelPos(0.65);						// etiquetas dentro del grafico

// Explode all slices
$p1->ExplodeAll(5);			// Separacion de las porciones

// Legends
$p1->SetLegends(array("PEM1C","PEM2C","PEM4C","PEM5C"));
$graph->legend->Pos(0.01,0.2);
// Add drop shadow
//$p1->SetShadow();

// Finally add the plot
$graph->Add($p1);

//$graph->Stroke();
$gdImgHandler = $graph->Stroke(_IMG_HANDLER);
$fileName = "../img/zDistPlanClaro.png";
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
						<img src="../img/zDistPlanClaro.png" width="370" height="250" alt="">
					</td></tr>
				</table>
			</td>
		</tr>
	</table>
<!--	<table>
		<tr align="center">
			<td>
				<img src="../img/zSimcards.png" width="370" height="250" alt="">
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
	</table>-->
</div>
</body>	
</html>

