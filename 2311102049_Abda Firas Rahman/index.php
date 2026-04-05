<?php require_once 'logika.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        /*Abda Firas Rahman - 2311102049 - IF-REG-01 */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #b6d0c8;
            color: #333;
            padding: 40px 20px;
        }
        
        /* Container biar ke tengaH */
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        /* Header Title */
        .header-title {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }
        .header-title span {
            color: #3498db;
        }

        /* Styling Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #e0e6ed;
        }
        th {
            background-color: #3498db;
            color: #ffffff;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 1px;
        }
        /* Efek hover tiap baris */
        tbody tr:hover {
            background-color: #f8fafc;
            transition: 0.3s ease;
        }

        /* Styling Badge Status */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
        }
        .status-lulus {
            background-color: #d1e7dd;
            color: #0f5132;
        }
        .status-gagal {
            background-color: #f8d7da;
            color: #842029;
        }

        /* Styling Summary Cards */
        .summary-container {
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }
        .summary-card {
            flex: 1;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #e0e6ed;
            border-left: 5px solid #3498db;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
            text-align: center;
        }
        .summary-card.tertinggi {
            border-left-color: #2ecc71;
        }
        .summary-card h4 {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .summary-card p {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header-title">
            <h2>Sistem Penilaian <span>Mahasiswa</span></h2>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Nilai Akhir</th>
                    <th>Grade</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hasil_penilaian as $index => $mhs): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td style="text-align: left; font-weight: 500;"><?= htmlspecialchars($mhs['nama']) ?></td>
                        <td><?= htmlspecialchars($mhs['nim']) ?></td>
                        <td><?= number_format($mhs['nilai_akhir'], 1) ?></td>
                        <td><strong><?= $mhs['grade'] ?></strong></td>
                        <td>
                            <span class="badge <?= $mhs['class_css'] ?>">
                                <?= $mhs['status'] ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="summary-container">
            <div class="summary-card">
                <h4>Rata-rata Kelas</h4>
                <p><?= number_format($rata_rata_kelas, 1) ?></p>
            </div>
            <div class="summary-card tertinggi">
                <h4>Nilai Tertinggi</h4>
                <p><?= number_format($nilai_tertinggi, 1) ?></p>
            </div>
        </div>
    </div>

</body>
</html>