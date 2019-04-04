<?php
$hora = date('H');
$hoy = date('Y-m-d');
$hoyY = date('Y');
$hoyM = date('m');
$hoyD = date('d');
$ayerD = $hoyD-1;
$ayer = $hoyY."-".$hoyM."-".$ayerD;

include './dbtasks.php';
    $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT		
        (SELECT COUNT(*) FROM bit_cdr WHERE date(calldate) = ?) AS TOTAL,
        (SELECT COUNT(*) FROM bit_cdr WHERE date(calldate) = ? AND DSTCHANNEL LIKE 'SIP/claro%') AS CLARO,
        (SELECT COUNT(*) FROM bit_cdr WHERE date(calldate) = ? AND DSTCHANNEL LIKE 'SIP/ALGUSAL%') AS ALGUSAL,
        (SELECT COUNT(*) FROM bit_cdr WHERE date(calldate) = ?  AND dstchannel LIKE 'SIP/IPLAN%') AS IPLAN";
        $q = $pdo->prepare($sql);
        $q->execute(array($hoy,$hoy,$hoy,$hoy));
        $data  = $q->fetch(PDO::FETCH_ASSOC);
        $total  = $data['TOTAL'];
        $claNow = $data['CLARO'];
        $algNow = $data['ALGUSAL'];
        $iplNow = $data['IPLAN'];
    //--------------------------------------------------
    if ($hora == '09'){
        $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT		
            (SELECT COUNT(*) FROM bit_cdr WHERE date(calldate) = ?) AS TOTALAYER,
            (SELECT COUNT(*) FROM bit_cdr WHERE date(calldate) = ?  AND DSTCHANNEL LIKE 'SIP/claro%') AS CLAROAYER,
            (SELECT COUNT(*) FROM bit_cdr WHERE date(calldate) = ?  AND DSTCHANNEL LIKE 'SIP/ALGUSAL%') AS ALGUSALAYER,
            (SELECT COUNT(*) FROM bit_cdr WHERE date(calldate) = ?  AND dstchannel LIKE 'SIP/IPLAN%') AS IPLANAYER";
            $q = $pdo->prepare($sql);
            $q->execute(array($ayer,$ayer,$ayer,$ayer));
            $data  = $q->fetch(PDO::FETCH_ASSOC);
            $totaly = $data['TOTALAYER'];
            $clay = $data['CLAROAYER'];
            $algy = $data['ALGUSALAYER'];
            $iply = $data['IPLANAYER'];
    }
    Database::disconnect();
   //--------------------------------------------------
    $dbName         = 'gepyme';
    $dbHost         = 'localhost';
    $dbUsername     = 'gepyme';
    $dbUserPassword = 'gepyme.123';
    $prov = array("Claro-Abril", "Algusal-Abril", "Iplan-Abril");

    $pdo = new PDO( "mysql:host=".$dbHost.";"."dbname=".$dbName, $dbUsername, $dbUserPassword);
        $sql = "UPDATE tablasGenerales set tgd01 = ?, tgd02 = ?, tgd03 = ?, tgd04 = ?
                where tgtabla ='RutaClaro' and tgcampo = 'TraficoActual'";
        $q = $pdo->prepare($sql);
        $q->execute(array($total,$claNow,$algNow,$iplNow));
    //-----------------------------------------------------------
    // Si es la hora 9, calculo el total de llamadas de ayer.
    if ($hora == '09'){
        foreach ($prov as $prome) {
            if ($ayerD==3){
                if ($prome == "Claro-Abril")   {$tgd = 'tgd03'; $tgval = $clay; $tgcampo = $prome;}
                if ($prome == "Algusal-Abril") {$tgd = 'tgd03'; $tgval = $algy; $tgcampo = $prome;}
                if ($prome == "Iplan-Abril")   {$tgd = 'tgd03'; $tgval = $iply; $tgcampo = $prome;}
            }
            if ($ayerD==4){
                if ($prome == "Claro-Abril")   {$tgd = 'tgd04'; $tgval = $clay; $tgcampo = $prome;}
                if ($prome == "Algusal-Abril") {$tgd = 'tgd04'; $tgval = $algy; $tgcampo = $prome;}
                if ($prome == "Iplan-Abril")   {$tgd = 'tgd04'; $tgval = $iply; $tgcampo = $prome;}
            }
            if ($ayerD==5){
                if ($prome == "Claro-Abril")   {$tgd = 'tgd05'; $tgval = $clay; $tgcampo = $prome;}
                if ($prome == "Algusal-Abril") {$tgd = 'tgd05'; $tgval = $algy; $tgcampo = $prome;}
                if ($prome == "Iplan-Abril")   {$tgd = 'tgd05'; $tgval = $iply; $tgcampo = $prome;}
            }
            if ($ayerD==6){
                if ($prome == "Claro-Abril")   {$tgd = 'tgd06'; $tgval = $clay; $tgcampo = $prome;}
                if ($prome == "Algusal-Abril") {$tgd = 'tgd06'; $tgval = $algy; $tgcampo = $prome;}
                if ($prome == "Iplan-Abril")   {$tgd = 'tgd06'; $tgval = $iply; $tgcampo = $prome;}
            }
            if ($ayerD==7){
                if ($prome == "Claro-Abril")   {$tgd = 'tgd07'; $tgval = $clay; $tgcampo = $prome;}
                if ($prome == "Algusal-Abril") {$tgd = 'tgd07'; $tgval = $algy; $tgcampo = $prome;}
                if ($prome == "Iplan-Abril")   {$tgd = 'tgd07'; $tgval = $iply; $tgcampo = $prome;}
            }
            if ($ayerD==8){
                if ($prome == "Claro-Abril")   {$tgd = 'tgd08'; $tgval = $clay; $tgcampo = $prome;}
                if ($prome == "Algusal-Abril") {$tgd = 'tgd08'; $tgval = $algy; $tgcampo = $prome;}
                if ($prome == "Iplan-Abril")   {$tgd = 'tgd08'; $tgval = $iply; $tgcampo = $prome;}
            }
            if ($ayerD==9){
                if ($prome == "Claro-Abril")   {$tgd = 'tgd09'; $tgval = $clay; $tgcampo = $prome;}
                if ($prome == "Algusal-Abril") {$tgd = 'tgd09'; $tgval = $algy; $tgcampo = $prome;}
                if ($prome == "Iplan-Abril")   {$tgd = 'tgd09'; $tgval = $iply; $tgcampo = $prome;}
            }
            if ($ayerD==10){
                if ($prome == "Claro-Abril")   {$tgd = 'tgd10'; $tgval = $clay; $tgcampo = $prome;}
                if ($prome == "Algusal-Abril") {$tgd = 'tgd10'; $tgval = $algy; $tgcampo = $prome;}
                if ($prome == "Iplan-Abril")   {$tgd = 'tgd10'; $tgval = $iply; $tgcampo = $prome;}
            }

            $sql="UPDATE tablasGenerales set tgd03 = ? where tgcampo = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($tgval,$tgcampo));
        }
    }
    Database::disconnect();
?>
