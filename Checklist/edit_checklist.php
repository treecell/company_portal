<?php
session_start();
if (!isset($_SESSION['user'])) header("Location: index.php");

$no = isset($_GET['no']) ? intval($_GET['no']) : 0;

if ($no > 0) {
    $rows = [];
    if (($f = fopen('data.csv', 'r')) !== false) {
        while (($row = fgetcsv($f)) !== false) {
            $rows[] = $row;
        }
        fclose($f);
    }
    // Hapus baris ke-$no (array dimulai dari 0)
    if (isset($rows[$no-1])) {
        // Hapus file tanda tangan jika ada
        if (!empty($rows[$no-1][14]) && file_exists($rows[$no-1][14])) {
            unlink($rows[$no-1][14]);
        }
        array_splice($rows, $no-1, 1);
        $f = fopen('data.csv', 'w');
        foreach ($rows as $r) {
            fputcsv($f, $r);
        }
        fclose($f);
        echo "<h2>Data berhasil dihapus!</h2><a href='index.php'>Kembali ke Dashboard</a>";
        exit;
    } else {
        echo "<h2>Data tidak ditemukan!</h2><a href='index.php'>Kembali</a>";
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}