<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

// Proses pilihan area
if (isset($_POST['status']) && isset($_POST['area'])) {
    $status = $_POST['status'];
    $area = implode(',', $_POST['area']); // Gabungkan jika lebih dari satu area dipilih
    header("Location: visit_form.php?status=$status&area=$area");
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Pilih Checklist & Area</title>
    <style>
        body {
            background: #00cfff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
        .container {
            background: #fff;
            max-width: 400px;
            margin: 60px auto 0 auto;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.10);
            padding: 32px 28px 24px 28px;
            text-align: center;
        }
        h2 {
            color: #0099cc;
            margin-bottom: 24px;
        }
        .menu-group {
            margin-bottom: 28px;
        }
        .menu-title {
            font-weight: bold;
            color: #007fa3;
            margin-bottom: 10px;
            font-size: 18px;
        }
        .menu-options {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 10px;
        }
        label {
            font-size: 16px;
            color: #333;
            cursor: pointer;
        }
        input[type="radio"], input[type="checkbox"] {
            margin-right: 8px;
            accent-color: #0099cc;
        }
        button {
            background: #0099cc;
            color: #fff;
            border: none;
            padding: 10px 28px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 18px;
        }
        button:hover {
            background: #007fa3;
        }
        a {
            color: #0099cc;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            margin-top: 18px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Pilih Checklist Masuk/Keluar Area</h2>
        <form method="post">
            <div class="menu-group">
                <div class="menu-title">Pilih Status Kunjungan</div>
                <div class="menu-options">
                    <label><input type="radio" name="status" value="Masuk" required> Masuk</label>
                    <label><input type="radio" name="status" value="Keluar" required> Keluar</label>
                </div>
            </div>
            <div class="menu-group">
                <div class="menu-title">Pilih Area</div>
                <div class="menu-options">
                    <label><input type="checkbox" name="area[]" value="HCA"> Container Area HCA</label>
                    <label><input type="checkbox" name="area[]" value="MCA"> Container Area MCA</label>
                </div>
            </div>
            <button type="submit">Lanjut</button>
        </form>
        <a href="index.php">Kembali ke Dashboard</a>