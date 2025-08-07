<?php
session_start();
if (!isset($_SESSION['user'])) header("Location: index.php");
date_default_timezone_set('Asia/Jakarta');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Checklist Higiene Visit</title>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>
    
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
            max-width: 2000px;
            margin: 48px auto 0 auto;
            border-radius: 24px;
            box-shadow: 0 6px 32px rgba(0,0,0,0.13);
            padding: 36px 32px 28px 32px;
        }
        .form-row {
            display: flex;
            gap: 32px;
            margin-bottom: 18px;
        }
        .form-col {
            flex: 1 1 0;
            min-width: 340px;
        }
        h2 {
            color: #0099cc;
            font-family: 'Segoe UI Semibold', Arial, sans-serif;
            margin-bottom: 22px;
            text-align: center;
        }
        h3, h4 {
            color: #0099cc;
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: 18px;
        }
        label {
            display: block;
            margin-bottom: 7px;
            font-weight: 500;
            color: #007fa3;
        }
        input[type="text"], input[type="number"], input[type="date"], input[type="time"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #b2ebf2;
            border-radius: 8px;
            font-size: 16px;
            background: #f4fcff;
            transition: border 0.2s;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        input[type="text"]:focus, input[type="number"]:focus, input[type="date"]:focus, input[type="time"]:focus, select:focus {
            border: 1.5px solid #0099cc;
            outline: none;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            background: #f8fafd;
        }
        th, td {
            padding: 8px 2px;
            border: 1px solid #b2ebf2;
            text-align: center;
        }
        th {
            background: #e0f7fa;
            color: #007fa3;
            font-family: 'Segoe UI Semibold', Arial, sans-serif;
            font-size: 15.5px;
        }
        .btn-group {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 10px;
        }
        button[type="button"], button[type="submit"] {
            background: linear-gradient(90deg, #00cfff 0%, #0099cc 100%);
            color: #fff;
            border: none;
            padding: 10px 28px;
            border-radius: 8px;
            font-size: 16px;
            font-family: 'Segoe UI Semibold', Arial, sans-serif;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            transition: background 0.2s;
        }
        button[type="button"]:hover, button[type="submit"]:hover {
            background: linear-gradient(90deg, #0099cc 0%, #00cfff 100%);
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: #0099cc;
            text-decoration: none;
            font-weight: bold;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        #signature-pad {
            border: 1.5px solid #b2ebf2;
            width: 100%;
            max-width: 350px;
            height: 110px;
            margin-bottom: 10px;
            border-radius: 8px;
            background: #f4fcff;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        @media (max-width: 900px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="image/aqua.png" alt="Logo" style="width:100px; height:auto; display:block; margin:0 auto 20px auto;">
            <h1 style="text-align:center;font-size:40px; color:#007fa3; font-weight:600; margin-bottom:10px;">FORM CHECKLIST HYGIENE VISIT</h1>
        </div>
        <p style="text-align:center; font-size:16px; color:#007fa3; font-weight:500;">
            Silakan isi form berikut untuk melakukan checklist masuk/keluar area Hygiene.
        </p>
        <form method="post" action="submit_visit.php" enctype="multipart/form-data" onsubmit="return saveSignature()">
            <!-- Data Pribadi -->
            <div class="form-row">
                <div class="form-col">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="">Pilih</option>
                        <option value="Karyawan">Karyawan</option>
                        <option value="Visitor">Visitor</option>
                    </select>
                    <label>ID Karyawan</label>
                    <input type="text" name="id_karyawan" required>
                    <label>Nama</label>
                    <input type="text" name="nama" required>
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" value="<?=date('Y-m-d')?>" required>
                    <label>Jam</label>
                    <input type="time" name="jam" value="<?=date('H:i')?>" required>
                    <label>Alasan Masuk/Keuar Area Hygiene</label>
                    <input type="text" name="Alasan" required>
                    <label>Lokasi</label>
                    <select name="Lokasi" required>
                        <option value="">Pilih Lokasi</option>
                        <option value="SUMBER">SUMBER</option>
                        <option value="HOD">HOD</option>
                        <option value="SPS1">SPS1</option>
                        <option value="SPS2">SPS2</option>
                        <option value="SPS3">SPS3</option>
                    </select>
                    <label>Area</label>
                    <select name="area" id="area" required onchange="showSubArea()">
                        <option value="">Pilih Area</option>
                        <option value="High Care">High Care</option>
                        <option value="Medium Care">Medium Care</option>
                    </select>
                    <div id="subarea-container" style="margin-bottom:15px; display:none;">
                        <label id="subarea-label"></label>
                        <select name="subarea" id="subarea" required style="display:none;">
                            <!-- Opsi subarea akan diisi via JS -->
                        </select>
                    </div>
                    <label>Pilihan</label>
                    <select name="pilihan" id="pilihan" required onchange="toggleHygieneCek()">
                        <option value="">Pilih</option>
                        <option value="Masuk">Masuk</option>
                        <option value="Keluar">Keluar</option>
                    </select>
                </div>
                <!-- Hygiene dan Peralatan Samping -->
                <div class="form-col">
                    
                        <div style="flex:1;">
                            <div id="hygiene-cek-section" style="display:none;">
                                <h3>Checklist Hygiene Personil</h3>
                                <table>
                                    <tr>
                                        <th style="width:40px;"></th>
                                        <th style="text-align:left;">Hygiene Cek</th>
                                        <th style="width:80px;">Ya</th>
                                        <th style="width:80px;">Tidak</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Kuku pendek dan bersih</td>
                                        <td><input type="checkbox" name="hygiene_kuku" value="Ya"></td>
                                        <td><input type="checkbox" name="hygiene_kuku" value="Tidak"></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Kumis dan/atau jenggot pendek dan rapi</td>
                                        <td><input type="checkbox" name="hygiene_jenggot" value="Ya"></td>
                                        <td><input type="checkbox" name="hygiene_jenggot" value="Tidak"></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Memakai perhiasan (cincin/jam tangan/gelang/kalung/dll)</td>
                                        <td><input type="checkbox" name="hygiene_perhiasan" value="Ya"></td>
                                        <td><input type="checkbox" name="hygiene_perhiasan" value="Tidak"></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Sedang menderita penyakit menular(seperti flu,batuk,dll)</td>
                                        <td><input type="checkbox" name="hygiene_penyakit" value="Ya"></td>
                                        <td><input type="checkbox" name="hygiene_penyakit" value="Tidak"></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Ada luka yang ditutup plester</td>
                                        <td><input type="checkbox" name="hygiene_luka" value="Ya"></td>
                                        <td><input type="checkbox" name="hygiene_luka" value="Tidak"></td>
                                    </tr>
                                </table>
                                <div style="margin-bottom:15px;">
                                    <label>
                                        <input type="checkbox" name="hygiene_agree" value="setuju">
                                        Saya setuju, jika saat inspeksi ditemukan kondisi berbeda dari yang diisikan, akan diberikan pembinaan sesuai peraturan yang berlaku
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div style="flex:1;">
                            <h3>Peralatan yang Dibawa</h3>
                            <table>
                                <tr>
                                    <th style="width:100px;"></th>
                                    <th style="text-align:left;">Nama Barang</th>
                                    <th style="width:120px;">Jumlah</th>
                                    <th style="width:120px;">Kondisi</th>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="alat[]" value="Handphone" id="cb_hp" onclick="toggleInput('hp')"></td>
                                    <td><label for="cb_hp" style="margin-bottom:0;">Handphone</label></td>
                                    <td><input type="number" name="hp_jml" id="hp_jml" min="0" value="0" disabled required></td>
                                    <td>
                                        <select name="hp_kondisi" id="hp_kondisi" disabled required>
                                            <option value="">Pilih</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                            <option value="Retak">Retak</option>
                                            <option value="Pecah">Pecah</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="alat[]" value="Kacamata" id="cb_kaca" onclick="toggleInput('kaca')"></td>
                                    <td><label for="cb_kaca" style="margin-bottom:0;">Kacamata</label></td>
                                    <td><input type="number" name="kaca_jml" id="kaca_jml" min="0" value="0" disabled required></td>
                                    <td>
                                        <select name="kaca_kondisi" id="kaca_kondisi" disabled required>
                                            <option value="">Pilih</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                            <option value="Retak">Retak</option>
                                            <option value="Pecah">Pecah</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="alat[]" value="Ballpoint/Tespen" id="cb_bp" onclick="toggleInput('bp')"></td>
                                    <td><label for="cb_bp" style="margin-bottom:0;">Ballpoint/Tespen</label></td>
                                    <td><input type="number" name="bp_jml" id="bp_jml" min="0" value="0" disabled required></td>
                                    <td>
                                        <select name="bp_kondisi" id="bp_kondisi" disabled required>
                                            <option value="">Pilih</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                            <option value="Retak">Retak</option>
                                            <option value="Pecah">Pecah</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="alat[]" value="Petridish" id="cb_petri" onclick="toggleInput('petri')"></td>
                                    <td><label for="cb_petri" style="margin-bottom:0;">Petridish</label></td>
                                    <td><input type="number" name="petri_jml" id="petri_jml" min="0" value="0" disabled required></td>
                                    <td>
                                        <select name="petri_kondisi" id="petri_kondisi" disabled required>
                                            <option value="">Pilih</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                            <option value="Retak">Retak</option>
                                            <option value="Pecah">Pecah</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="alat[]" value="Glassware Lab" id="cb_glass" onclick="toggleInput('glass')"></td>
                                    <td><label for="cb_glass" style="margin-bottom:0;">Glassware Lab</label></td>
                                    <td><input type="number" name="glass_jml" id="glass_jml" min="0" value="0" disabled required></td>
                                    <td>
                                        <select name="glass_kondisi" id="glass_kondisi" disabled required>
                                            <option value="">Pilih</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                            <option value="Retak">Retak</option>
                                            <option value="Pecah">Pecah</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <label>Lainnya</label>
                            <input type="text" name="lain_nama" placeholder="Nama Barang">
                            <input type="number" name="lain_jml" min="0" value="0" placeholder="Jumlah">
                            <input type="text" name="lain_kondisi" placeholder="Kondisi">
                        </div>
                    
                </div>
            </div>
            <h4>Tanda Tangan</h4>
            <canvas id="signature-pad"></canvas>
            <input type="hidden" name="signature" id="signature">
            <div class="btn-group">
                <button type="button" onclick="clearPad()">Clear</button>
                <button type="submit">Submit</button>
            </div>
        </form>
        <a class="back-link" href="index.php">Kembali ke Dashboard</a>
    </div>
    <script>
    function toggleInput(prefix) {
        var cb = document.getElementById('cb_' + prefix);
        document.getElementById(prefix + '_jml').disabled = !cb.checked;
        document.getElementById(prefix + '_kondisi').disabled = !cb.checked;
        if (!cb.checked) {
            document.getElementById(prefix + '_jml').value = 0;
            document.getElementById(prefix + '_kondisi').value = '';
        }
    }
    function showSubArea() {
        var area = document.getElementById('area').value;
        var subareaContainer = document.getElementById('subarea-container');
        var subareaLabel = document.getElementById('subarea-label');
        var subareaSelect = document.getElementById('subarea');
        subareaSelect.innerHTML = '';
        if (area === "High Care") {
            subareaContainer.style.display = 'block';
            subareaLabel.innerText = "Pilih Sub Area";
            subareaSelect.style.display = 'inline-block';
            subareaSelect.innerHTML = '<option value="">Filler</option>';
        } else if (area === "Medium Care") {
            subareaContainer.style.display = 'block';
            subareaLabel.innerText = "Pilih Sub Area";
            subareaSelect.style.display = 'inline-block';
            subareaSelect.innerHTML = '<option value="">Pilih Sub Area</option>'
                + '<option value="Sumber Sigedang">Sumber Sigedang</option>'
                + '<option value="Washer">Washer</option>'
                + '<option value="SBO">SBO</option>'
                + '<option value="Kemasan">Kemasan</option>';
        } else {
            subareaContainer.style.display = 'none';
            subareaSelect.style.display = 'none';
        }
    }
    function toggleHygieneCek() {
        var pilihan = document.getElementById('pilihan').value;
        var hygieneDiv = document.getElementById('hygiene-cek-section');
        if (pilihan === "Masuk") {
            hygieneDiv.style.display = 'block';
        } else {
            hygieneDiv.style.display = 'none';
        }
    }
    var canvas = document.getElementById('signature-pad');
    var signaturePad = new SignaturePad(canvas);
    function clearPad() { signaturePad.clear(); }
    function saveSignature() {
        if (signaturePad.isEmpty()) { alert('Tanda tangan wajib diisi!'); return false; }
        document.getElementById('signature').value = signaturePad.toDataURL();
        return true;
    }
    </script>
</body>
</html>