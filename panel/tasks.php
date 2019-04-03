<?php
$hora = date('H');
$hoy = date('Y-m-d');
$hoyY = date('Y');
$hoyM = date('m');
$hoyD = date('d');
$ayerD = $hoyD-1;

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
            $q->execute(array($ayerD,$ayerD,$ayerD,$ayerD));
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
        $sql = "UPDATE tablasGenerales 
                set tgd01   = ?,
                    tgd02   = ?,
                    tgd03   = ?,
                    tgd04   = ?
                where tgtabla ='RutaClaro' and tgcampo = 'TraficoActual'";
        $q = $pdo->prepare($sql);
        $q->execute(array($total,$claNow,$algNow,$iplNow));
    //-----------------------------------------------------------
    // Si es la hora 9, calculo el total de llamadas de ayer.
    if ($hora == '09'){
        foreach ($prov as $prome) {
            if ($ayerD==2){
                if ($prome == "Claro-Abril")
                    echo "UPDATE tablasGenerales set tgd01 = ".$clay." where tgcampo = ".$prome;
                if ($prome == "Algusal-Abril")
                    echo "UPDATE tablasGenerales set tgd01 = ".$algy." where tgcampo = ".$prome;
                if ($prome == "Iplan-Abril")
                    echo "UPDATE tablasGenerales set tgd01 = ".$iply." where tgcampo = ".$prome;
            }
            if ($ayerD==3){
                if ($prome == "Claro-Abril")
                    echo "UPDATE tablasGenerales set tgd02 = ".$clay." where tgcampo = ".$prome;
                if ($prome == "Algusal-Abril")
                    echo "UPDATE tablasGenerales set tgd02 = ".$algy." where tgcampo = ".$prome;
                if ($prome == "Iplan-Abril")
                    echo "UPDATE tablasGenerales set tgd02 = ".$iply." where tgcampo = ".$prome;
            }
            if ($ayerD==4){
                if ($prome == "Claro-Abril")
                    echo "UPDATE tablasGenerales set tgd03 = ".$clay." where tgcampo = ".$prome;
                if ($prome == "Algusal-Abril")
                    echo "UPDATE tablasGenerales set tgd03 = ".$algy." where tgcampo = ".$prome;
                if ($prome == "Iplan-Abril")
                    echo "UPDATE tablasGenerales set tgd03 = ".$iply." where tgcampo = ".$prome;
            }
        }
    }
    Database::disconnect();
?>