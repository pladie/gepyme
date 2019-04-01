<?php
include '../database.php';
// $pdo = Database::connect();
// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $sql = "SELECT COUNT(*) FROM tablasGenerales WHERE tgtabla = 'RutaClaro' and tgcampo = '?') AS Iplan";
// $q = $pdo->prepare($sql);
// $q->execute(array("Claro-Enero"));
$valor = 'Claro-Enero';
// Database::disconnect();

$pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT (tgd01+tgd02+tgd03+tgd04+tgd05+tgd06+tgd07+tgd08+tgd09
                +tgd10+ tgd11+tgd12+tgd13+tgd14+tgd15+tgd16+tgd17+tgd18+tgd19
                +tgd20+ tgd21+tgd22+tgd23+tgd24+tgd25+tgd26+tgd27+tgd28+tgd29+tgd30+ tgd31) as canClaEne FROM tablasGenerales where tgtabla = 'RutaClaro' and tgcampo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($valor));
        $data = $q->fetch(PDO::FETCH_ASSOC);
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
 	<a href="menuPanel.php">Volver</a>
</div>
<div align="center">
    <p class="title"><strong>Prueba</strong></p>
    <br>
    <?php echo $data['canClaEne'];?>
</div>
</body>
</html>
