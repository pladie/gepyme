<?php 
require_once ('../jpgraph/jpgraph.php');
require_once ('../jpgraph/jpgraph_bar.php');
include '../database.php';

$pdo = Database::connect();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT
     (SELECT (tgd01+tgd02+tgd03+tgd04+tgd05+tgd06+tgd07+tgd08+tgd09+tgd10+tgd11+tgd12+tgd13+tgd14+tgd15+tgd16+tgd17+tgd18+tgd19+tgd20+tgd21+tgd22+tgd23+tgd24+tgd25+tgd26+tgd27+tgd28+tgd29+tgd30+tgd31) FROM tablasGenerales where tgtabla = ? and tgcampo = 'Claro-Enero')   AS CLAENE,
     (SELECT (tgd01+tgd02+tgd03+tgd04+tgd05+tgd06+tgd07+tgd08+tgd09+tgd10+tgd11+tgd12+tgd13+tgd14+tgd15+tgd16+tgd17+tgd18+tgd19+tgd20+tgd21+tgd22+tgd23+tgd24+tgd25+tgd26+tgd27+tgd28+tgd29+tgd30+tgd31) FROM tablasGenerales where tgtabla = ? and tgcampo = 'Algusal-Enero') AS ALGENE,
     (SELECT (tgd01+tgd02+tgd03+tgd04+tgd05+tgd06+tgd07+tgd08+tgd09+tgd10+tgd11+tgd12+tgd13+tgd14+tgd15+tgd16+tgd17+tgd18+tgd19+tgd20+tgd21+tgd22+tgd23+tgd24+tgd25+tgd26+tgd27+tgd28+tgd29+tgd30+tgd31) FROM tablasGenerales where tgtabla = ? and tgcampo = 'Iplan-Enero')   AS IPLENE,
     (SELECT (tgd01+tgd02+tgd03+tgd04+tgd05+tgd06+tgd07+tgd08+tgd09+tgd10+tgd11+tgd12+tgd13+tgd14+tgd15+tgd16+tgd17+tgd18+tgd19+tgd20+tgd21+tgd22+tgd23+tgd24+tgd25+tgd26+tgd27+tgd28) FROM tablasGenerales where tgtabla = ? and tgcampo = 'Claro-Febrero')   AS CLAFEB,
     (SELECT (tgd01+tgd02+tgd03+tgd04+tgd05+tgd06+tgd07+tgd08+tgd09+tgd10+tgd11+tgd12+tgd13+tgd14+tgd15+tgd16+tgd17+tgd18+tgd19+tgd20+tgd21+tgd22+tgd23+tgd24+tgd25+tgd26+tgd27+tgd28) FROM tablasGenerales where tgtabla = ? and tgcampo = 'Algusal-Febrero') AS ALGFEB,
     (SELECT (tgd01+tgd02+tgd03+tgd04+tgd05+tgd06+tgd07+tgd08+tgd09+tgd10+tgd11+tgd12+tgd13+tgd14+tgd15+tgd16+tgd17+tgd18+tgd19+tgd20+tgd21+tgd22+tgd23+tgd24+tgd25+tgd26+tgd27+tgd28) FROM tablasGenerales where tgtabla = ? and tgcampo = 'Iplan-Febrero')   AS IPLFEB,
     (SELECT (tgd01+tgd02+tgd03+tgd04+tgd05+tgd06+tgd07+tgd08+tgd09+tgd10+tgd11+tgd12+tgd13+tgd14+tgd15+tgd16+tgd17+tgd18+tgd19+tgd20+tgd21+tgd22+tgd23+tgd24+tgd25+tgd26+tgd27+tgd28+tgd29+tgd30+tgd31) FROM tablasGenerales where tgtabla = ? and tgcampo = 'Claro-Marzo')   AS CLAMAR,
     (SELECT (tgd01+tgd02+tgd03+tgd04+tgd05+tgd06+tgd07+tgd08+tgd09+tgd10+tgd11+tgd12+tgd13+tgd14+tgd15+tgd16+tgd17+tgd18+tgd19+tgd20+tgd21+tgd22+tgd23+tgd24+tgd25+tgd26+tgd27+tgd28+tgd29+tgd30+tgd31) FROM tablasGenerales where tgtabla = ? and tgcampo = 'Algusal-Marzo') AS ALGMAR,
     (SELECT (tgd01+tgd02+tgd03+tgd04+tgd05+tgd06+tgd07+tgd08+tgd09+tgd10+tgd11+tgd12+tgd13+tgd14+tgd15+tgd16+tgd17+tgd18+tgd19+tgd20+tgd21+tgd22+tgd23+tgd24+tgd25+tgd26+tgd27+tgd28+tgd29+tgd30+tgd31) FROM tablasGenerales where tgtabla = ? and tgcampo = 'Iplan-Marzo')   AS IPLMAR";
  $q = $pdo->prepare($sql);
  $q->execute(array('RutaClaro','RutaClaro','RutaClaro','RutaClaro','RutaClaro','RutaClaro','RutaClaro','RutaClaro','RutaClaro'));
  $data   = $q->fetch(PDO::FETCH_ASSOC);
 Database::disconnect();


$totEneCla = $data['CLAENE'];
$totEneAlg = $data['ALGENE'];
$totEneIpl = $data['IPLENE'];
$totFebCla = $data['CLAFEB'];
$totFebAlg = $data['ALGFEB'];
$totFebIpl = $data['IPLFEB'];
$totMarCla = $data['CLAMAR'];
$totMarAlg = $data['ALGMAR'];
$totMarIpl = $data['IPLMAR'];

$data1y=array($totEneCla,$totFebCla,$totMarCla);
$data2y=array($totEneAlg,$totFebAlg,$totMarAlg);
$data3y=array($totEneIpl,$totFebIpl,$totMarIpl);
 
// Create the graph. These two calls are always required
$graph = new Graph(500,250);    
$graph->SetScale("textlin");
 
$graph->SetShadow();
$graph->img->SetMargin(70,30,20,40);
$graph->xaxis->SetTickLabels($gDateLocale->GetShortMonth());
//$graph->xaxis->SetTickLabels("Ene","Feb","Mar");

// Create the bar plots
$b1plot = new BarPlot($data1y);
$b1plot->SetFillColor("orange");
$b2plot = new BarPlot($data2y);
$b2plot->SetFillColor("blue");
$b3plot = new BarPlot($data3y);
$b3plot->SetFillColor("green");
 
// Create the grouped bar plot
$gbplot = new GroupBarPlot(array($b1plot,$b2plot,$b3plot));
 
$graph->title->Set("Histograma");
$graph->xaxis->title->Set("2019");
//$graph->yaxis->title->Set("Cant. llamadas");
 
$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Adjust the legend position
//$graph->SetLegends(array('Claro','Movistar','Personal'));
//$graph->legend->SetLayout(LEGEND_HOR);
//$graph->legend->Pos(0.49,0.95,"center","bottom");

// Display the graph
$graph->Add($gbplot);
$gdImgHandler = $graph->Stroke(_IMG_HANDLER);

//$graph->Stroke();
$fileName = "../img/zHistLlam.png";
$graph->img->Stream($fileName);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link href="../css/gepyme.css" rel="stylesheet" type="text/css">
</head>
<body class="body">
<div align="left" class="volver">
 	<a href="menuPanel.php">Volver</a>
</div>
  <div align="center">
    <p class="title"><strong>Ruta Claro<//strong>
    <div class="row">
      <table>
        <tr align="center">
          <td><img src="../img/zHistLlam.png" width="500" height="260" alt=""></td>
        </tr>
      </table>
      <table class="tableli">
        <thead>
          <tr>
            <th>Empresa-Mes/Dia</th><th>01</th><th>02</th><th>03</th><th>04</th><th>05</th><th>06</th><th>07</th><th>08</th><th>09</th>
                         <th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th><th>19</th>
                         <th>20</th><th>21</th><th>22</th><th>23</th><th>24</th><th>25</th><th>26</th><th>27</th><th>28</th><th>29</th>
                         <th>30</th><th>31</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $pdo = Database::connect();
            $sql = 'SELECT * FROM tablasGenerales WHERE tgtabla = "RutaClaro" AND tgcampo LIKE "%Abril"';      
            foreach ($pdo->query($sql) as $row) {
              echo '<tr>';
              echo '<td>'. $row['tgcampo'] . '</td>';
              echo '<td>'. $row['tgd01'] . '</td>';
              echo '<td>'. $row['tgd02'] . '</td>';
              echo '<td>'. $row['tgd03'] . '</td>';
              echo '<td>'. $row['tgd04'] . '</td>';
              echo '<td>'. $row['tgd05'] . '</td>';
              echo '<td>'. $row['tgd06'] . '</td>';
              echo '<td>'. $row['tgd07'] . '</td>';
              echo '<td>'. $row['tgd08'] . '</td>';
              echo '<td>'. $row['tgd09'] . '</td>';
              echo '<td>'. $row['tgd10'] . '</td>';
              echo '<td>'. $row['tgd11'] . '</td>';
              echo '<td>'. $row['tgd12'] . '</td>';
              echo '<td>'. $row['tgd13'] . '</td>';
              echo '<td>'. $row['tgd14'] . '</td>';
              echo '<td>'. $row['tgd15'] . '</td>';
              echo '<td>'. $row['tgd16'] . '</td>';
              echo '<td>'. $row['tgd17'] . '</td>';
              echo '<td>'. $row['tgd18'] . '</td>';
              echo '<td>'. $row['tgd19'] . '</td>';
              echo '<td>'. $row['tgd20'] . '</td>';
              echo '<td>'. $row['tgd21'] . '</td>';
              echo '<td>'. $row['tgd22'] . '</td>';
              echo '<td>'. $row['tgd23'] . '</td>';
              echo '<td>'. $row['tgd24'] . '</td>';
              echo '<td>'. $row['tgd25'] . '</td>';
              echo '<td>'. $row['tgd26'] . '</td>';
              echo '<td>'. $row['tgd27'] . '</td>';
              echo '<td>'. $row['tgd28'] . '</td>';
              echo '<td>'. $row['tgd29'] . '</td>';
              echo '<td>'. $row['tgd30'] . '</td>';
              echo '<td>'. $row['tgd31'] . '</td>';
              echo '</tr>';
            }
            Database::disconnect();
          ?>
        </tbody>
      </table>
      <br>
      <table class="tableli">
        <thead>
          <tr>
            <th>Empresa</th><th>Cantidad de llamadas actual</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT 
               (select tgd01 FROM tablasGenerales where tgcampo = ?) as totNow, 
               (select tgd02 FROM tablasGenerales where tgcampo = ?) as claNow, 
               (select tgd03 FROM tablasGenerales where tgcampo = ?) as algNow, 
               (select tgd04 FROM tablasGenerales where tgcampo = ?) as iplNow";
        $q = $pdo->prepare($sql);
        $q->execute(array("TraficoActual","TraficoActual","TraficoActual","TraficoActual"));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $totNow = $data['totNow'];
        $claNow = $data['claNow'];
        $algNow = $data['algNow'];
        $iplNow = $data['iplNow'];
        Database::disconnect();
        ?>
          <tr align="left"><td><?php echo 'Claro'; ?></td><td><?php echo $claNow; ?></td></tr>
          <tr align="left"><td><?php echo 'Algusal'; ?></td><td><?php echo $algNow; ?></td></tr>
          <tr align="left"><td><?php echo 'Iplan'; ?></td><td><?php echo $iplNow; ?></td></tr>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
