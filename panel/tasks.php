<?php
$hoy = date('Y-m-d');

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
    Database::disconnect();
   //--------------------------------------------------
    $dbName         = 'gepyme';
    $dbHost         = 'localhost';
    $dbUsername     = 'gepyme';
    $dbUserPassword = 'gepyme.123';

    //$pdo = Database::connect();
    $pdo = new PDO( "mysql:host=".$dbHost.";"."dbname=".$dbName, $dbUsername, $dbUserPassword);
        $sql = "UPDATE tablasGenerales 
                set tgd01   = ?,
                    tgd02   = ?,
                    tgd03   = ?,
                    tgd04   = ?
                where tgtabla ='RutaClaro' and tgcampo = 'TraficoActual'";
        $q = $pdo->prepare($sql);
        $q->execute(array($total,$claNow,$algNow,$iplNow));
    Database::disconnect();
?>