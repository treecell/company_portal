<?php
$masuk = $keluar = 0;
if (($f = fopen('data.csv','r')) !== false) {
    while (($row = fgetcsv($f)) !== false) {
        if (isset($row[6])) {
            if ($row[6]=='Masuk') $masuk++;
            if ($row[6]=='Keluar') $keluar++;
        }
    }
    fclose($f);
}
header('Content-Type: application/json');
echo json_encode(['masuk'=>$masuk, 'keluar'=>$keluar]);
