<?php
session_start();
if (isset($_POST['login'])) {
    // Dummy login, ganti dengan validasi database jika perlu
    if ($_POST['username'] && $_POST['password']) {
        $_SESSION['user'] = $_POST['username'];
    }
}
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
if (!isset($_SESSION['user'])):
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Higiene Visit</title>
    <style>
        body {
            background: linear-gradient(135deg, #00cfff 0%, #4fd1ff 100%);
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            color: #222;
        }
        .container {
            background: #fff;
            max-width: 370px;
            margin: 60px auto 0 auto;
            border-radius: 16px;
            box-shadow: 0 6px 32px rgba(0,0,0,0.13);
            padding: 36px 32px 28px 32px;
            text-align: center;
        }
        h1, h2, h3 {
            color: #0099cc;
            font-family: 'Segoe UI Semibold', Arial, sans-serif;
            margin-bottom: 18px;
        }
        input[type="text"], input[type="password"] {
            width: 92%;
            padding: 12px;
            margin: 12px 0 20px 0;
            border: 1px solid #b2ebf2;
            border-radius: 8px;
            font-size: 17px;
            background: #f4fcff;
            transition: border 0.2s;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border: 1.5px solid #0099cc;
            outline: none;
        }
        button {
            background: linear-gradient(90deg, #00cfff 0%, #0099cc 100%);
            color: #fff;
            border: none;
            padding: 12px 32px;
            border-radius: 8px;
            font-size: 17px;
            font-family: 'Segoe UI Semibold', Arial, sans-serif;
            cursor: pointer;
            margin-top: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            transition: background 0.2s;
        }
        button:hover {
            background: linear-gradient(90deg, #0099cc 0%, #00cfff 100%);
        }
        .dashboard-container {
            background: #fff;
            max-width: 950px;
            margin: 48px auto 0 auto;
            border-radius: 16px;
            box-shadow: 0 6px 32px rgba(0,0,0,0.13);
            padding: 36px 36px 28px 36px;
        }
        a {
            color: #0099cc;
            text-decoration: none;
            font-weight: bold;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        a:hover {
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 22px;
            background: #f8fafd;
            font-size: 15px;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        th, td {
            padding: 10px 7px;
            border: 1px solid #b2ebf2;
            text-align: center;
        }
        th {
            background: #e0f7fa;
            color: #007fa3;
            font-family: 'Segoe UI Semibold', Arial, sans-serif;
            font-size: 15.5px;
        }
        .logout-link {
            float: right;
        }
        @media (max-width: 700px) {
            .dashboard-container {
                padding: 16px 4px 12px 4px;
            }
            table, th, td {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo Aqua, ganti src sesuai lokasi file logo Anda -->
        <img src="image/aqua.png" alt="aqua" style="width: 100px; margin-bottom: 20px;">
        <h2>Selamat Datang</h2>
        <h1>Login Higiene Visit</h1>
        <p>Silakan login untuk mengakses dashboard.</p>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button name="login">Login</button>
        </form>
    </div>
</body>
</html>
<?php else: ?>
    <div class="dashboard-container">
        <h2>Dashboard Higiene Visit</h2>
        <p>Selamat datang, <?=htmlspecialchars($_SESSION['user'])?> | <a class="logout-link" href="?logout=1">Logout</a></p>
        <a href="visit_menu.php">+ Isi Checklist Masuk/Keluar Area</a>
        <h3>Grafik Kunjungan</h3>
        <canvas id="visitChart" width="400" height="150"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
        fetch('chart.php').then(r=>r.json()).then(data=>{
            new Chart(document.getElementById('visitChart'), {
                type: 'bar',
                data: {
                    labels: ['Masuk', 'Keluar'],
                    datasets: [{
                        label: 'Jumlah',
                        data: [data.masuk, data.keluar],
                        backgroundColor: ['#4caf50','#f44336']
                    }]
                }
            });
        });
        </script>
        <h3>Rekap Kunjungan</h3>
        <a href="download.php">Download Excel</a>
        <table style="border:2px solid #0099cc;">
            <tr>
                <th style="border:1px solid #0099cc;">No</th>
                <th style="border:1px solid #0099cc;">Status</th>
                <th style="border:1px solid #0099cc;">ID</th>
                <th style="border:1px solid #0099cc;">Nama</th>
                <th style="border:1px solid #0099cc;">Tanggal</th>
                <th style="border:1px solid #0099cc;">Jam</th>
                <th style="border:1px solid #0099cc;">Area</th>
                <th style="border:1px solid #0099cc;">Pilihan</th>
                <th style="border:1px solid #0099cc;">Handphone</th>
                <th style="border:1px solid #0099cc;">Kacamata</th>
                <th style="border:1px solid #0099cc;">Ballpoint/Tespen</th>
                <th style="border:1px solid #0099cc;">Petridish</th>
                <th style="border:1px solid #0099cc;">Glassware Lab</th>
                <th style="border:1px solid #0099cc;">Lainnya</th>
                <th style="border:1px solid #0099cc;">user</th>
                <th style="border:1px solid #0099cc;">Tanda Tangan</th>
                <th style="border:1px solid #0099cc;">created at</th>
            </tr>
            <?php
            $no=1;
            if (($f = fopen('data.csv','r')) !== false) {
                while (($row = fgetcsv($f)) !== false) {
                    echo "<tr>";
                    echo "<td style='border:1px solid #0099cc;'>$no</td>"; // Auto increment No
                    foreach($row as $i=>$col) {
                        if ($i==14) echo "<td style='border:1px solid #0099cc;'><img src='$col' width='80'></td>";
                        else echo "<td style='border:1px solid #0099cc;'>".htmlspecialchars($col)."</td>";
                    }
                    echo "<td style='border:1px solid #0099cc;'>
                        <a href='edit_checklist.php?no=$no' style='color:#007fa3;font-weight:bold;'>Edit</a> | 
                        <a href='hapus_checklist.php?no=$no' style='color:#f44336;font-weight:bold;' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a>
                    </td>";
                    echo "</tr>";
                    $no++;
                }
                fclose($f);
            }
            ?>
        </table>
    </div>
</body>
</html>
<?php endif; ?>