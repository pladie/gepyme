<?php
    require_once '../database.php';

    // output headers so that the file is downloaded rather than displayed
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');

    // create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');

    // output the column headings
    fputcsv($output, array('Proveedor', 'EneMar', 'AbrJun','JulSep','OctDic','Actual'));

    // fetch the data
    $pdo = Database::connect();
    
    //$rows = mysql_query('SELECT field1,field2,field3 FROM table');
    //$rows = mysql_query('SELECT facproveedor, EneMar, AbrJun, JulSep, OctDic, factempAct AS Actual FROM factemp');
    $sql1 = "SELECT facproveedor, EneMar, AbrJun, JulSep, OctDic, factempAct AS Actual  
                   FROM factemp;";

    Database::disconnect();

    // loop over the rows, outputting them
    //while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);
    //while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);
    foreach ($pdo->query($sql1) as $row) {
        $linea=array($row['facproveedor'],$row['EneMar'],$row['AbrJun'],$row['JulSep'],$row['OctDic'],$row['Actual']);
        fputcsv($output, $linea);
    }
    fclose($output);
?>