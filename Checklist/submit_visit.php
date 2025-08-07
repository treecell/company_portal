<?php
session_start();
if (!isset($_SESSION['user'])) header("Location: index.php");
if ($_SERVER['REQUEST_METHOD']=='POST') {
    // Helper untuk ambil nilai POST jika ada, jika tidak isi default
    function getval($key, $default = '') {
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }

    $row = [
        getval('status'),
        getval('id_karyawan'),
        getval('nama'),
        getval('tanggal'),
        getval('jam'),
        getval('alasan'),
        getval('lokasi'),
        getval('area'),
        getval('pilihan'),
        getval('hp_jml', 0) . '/' . getval('hp_kondisi'),
        getval('kaca_jml', 0) . '/' . getval('kaca_kondisi'),
        getval('bp_jml', 0) . '/' . getval('bp_kondisi'),
        getval('petri_jml', 0) . '/' . getval('petri_kondisi'),
        getval('glass_jml', 0) . '/' . getval('glass_kondisi'),
        getval('lain_jml', 0) . '/' . getval('lain_kondisi'),
        $_SESSION['user'],
        '', // signature img path
        date('Y-m-d H:i:s'), // created at timestamp
        getval('edit')
    ];
    // Simpan signature
    if (isset($_POST['signature']) && strpos($_POST['signature'], 'data:image/png;base64,')===0) {
        $img = $_POST['signature'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $imgData = base64_decode($img);
        $imgName = 'signatures/'.uniqid().'.png';
        if (!is_dir('signatures')) mkdir('signatures');
        file_put_contents($imgName, $imgData);
        $row[14] = $imgName;
    }
    $f = fopen('data.csv','a');
    fputcsv($f, $row);
    fclose($f);
    echo "<h2>Terima kasih, data berhasil disimpan!</h2><a href='index.php'>Kembali ke Dashboard</a>";
} else {
    header("Location: visit_form.php");
}