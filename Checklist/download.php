<?php
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="rekap_higiene_visit.csv"');
$header = [
    'No',
    'Status',
    'ID',
    'Nama',
    'Tanggal',
    'Jam',
    'Alasan',
    'Lokasi',
    'Area',
    'Pilihan',
    'Handphone',
    'Kacamata',
    'Ballpoint/Tespen',
    'Petridish',
    'Glassware Lab',
    'Lainnya',
    'Tanda Tangan'
];

$output = fopen('php://output', 'w');
fputcsv($output, $header);

if (($f = fopen('data.csv', 'r')) !== false) {
    $no = 1;
    while (($row = fgetcsv($f)) !== false) {
        array_unshift($row, $no); // Tambahkan nomor di depan
        fputcsv($output, $row);
        $no++;
    }
    fclose($f);
}
fclose($output);
exit;
readfile('data.csv');