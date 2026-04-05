<?php

// Array asosiasi data mahasiswa
 $mahasiswa = [
    [
        'nama' => 'Diva Octaviani',
        'nim'  => '2311102006',
        'tugas' => 88,
        'uts'   => 90,
        'uas'   => 100
    ],
    [
        'nama' => 'Ariana Swift',
        'nim'  => '2311113007',
        'tugas' => 70,
        'uts'   => 65,
        'uas'   => 60
    ],
    [
        'nama' => 'Kimi Antonelli',
        'nim'  => '2311113008',
        'tugas' => 60,
        'uts'   => 70,
        'uas'   => 75
    ],
    [
        'nama' => 'George Russell',
        'nim'  => '2311113009',
        'tugas' => 90,
        'uts'   => 88,
        'uas'   => 95
    ],
    [
        'nama' => 'Wednesday',
        'nim'  => '2311113010',
        'tugas' => 50,
        'uts'   => 55,
        'uas'   => 45
    ]
];

// Function untuk menghitung nilai akhir
function hitungNilai($tugas, $uts, $uas) {
    $nilai_akhir = ($tugas * 0.20) + ($uts * 0.30) + ($uas * 0.50);
    return $nilai_akhir;
}

// Hitung total nilai untuk rata-rata dan cari nilai tertinggi
 $total_nilai = 0;
 $nilai_max = 0;
foreach ($mahasiswa as $mhs) {
    $na = hitungNilai($mhs['tugas'], $mhs['uts'], $mhs['uas']);
    $total_nilai += $na;
    if ($na > $nilai_max) {
        $nilai_max = $na;
    }
}

// Rata-rata kelas
 $rata_rata = $total_nilai / count($mahasiswa);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penilaian Mahasiswa</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #dee2e6;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .header {
            background-color: #0056b3;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .content {
            padding: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th {
            background: linear-gradient(135deg, #0056b3, #0074d9);
            color: #ffffff;
            font-weight: 600;
            font-size: 13px;
            padding: 13px 8px;
            letter-spacing: 0.3px;
        }

        td {
            padding: 10px 8px;
            border-bottom: 1px solid #eee;
            text-align: center;
            font-size: 14px;
        }

        tbody tr:hover {
            background-color: #f1f8ff;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .lulus {
            background-color: #d4edda;
            color: #155724;
        }
        .tidak-lulus {
            background-color: #f8d7da;
            color: #721c24;
        }

        .stats-container {
            display: flex;
            gap: 15px;
            margin-bottom: 5px;
        }
        .stat-card {
            flex: 1;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            border-top: 3px solid #0056b3;
        }
        .stat-card h3 {
            margin: 0 0 5px 0;
            font-size: 13px;
            color: #666;
        }
        .stat-card p {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Data Penilaian Mahasiswa</h2>
    </div>

    <div class="content">
        <div class="stats-container">
            <div class="stat-card">
                <h3>Rata-rata Nilai Kelas</h3>
                <p><?= number_format($rata_rata, 2); ?></p>
            </div>
            <div class="stat-card">
                <h3>Nilai Tertinggi</h3>
                <p><?= number_format($nilai_max, 2); ?></p>
            </div>
        </div>
        
        <!-- Tabel HTML untuk menampilkan seluruh data mahasiswa
             Output: Nama, NIM, Nilai Akhir, Grade, Status -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>NIM</th>
                    <th>Tugas (20%)</th>
                    <th>UTS (30%)</th>
                    <th>UAS (50%)</th>
                    <th>Nilai Akhir</th>
                    <th>Grade</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>

                <!-- Loop (foreach) untuk menampilkan seluruh data mahasiswa -->
                <?php foreach ($mahasiswa as $mhs): ?>
                    <?php
                    $na = hitungNilai($mhs['tugas'], $mhs['uts'], $mhs['uas']);

                    // If/else untuk menentukan Grade menggunakan Operator Perbandingan (>=)
                    if ($na >= 85) { $grade = 'A'; } 
                    elseif ($na >= 70) { $grade = 'B'; } 
                    elseif ($na >= 60) { $grade = 'C'; } 
                    elseif ($na >= 50) { $grade = 'D'; } 
                    else { $grade = 'E'; }

                    // If/else untuk menentukan Status Kelulusan menggunakan operator perbandingan (>=)
                    if ($na >= 60) {
                        $status = 'LULUS';
                        $class_status = 'lulus';
                    } else {
                        $status = 'TIDAK LULUS';
                        $class_status = 'tidak-lulus';
                    }
                    ?>

                    <tr>
                        <td><?= $no++; ?></td>
                        <td style="text-align: left;"><?= $mhs['nama']; ?></td>
                        <td><?= $mhs['nim']; ?></td>
                        <td><?= $mhs['tugas']; ?></td>
                        <td><?= $mhs['uts']; ?></td>
                        <td><?= $mhs['uas']; ?></td>
                        <td><?= number_format($na, 2); ?></td>
                        <td><?= $grade; ?></td>
                        <td><span class="badge <?= $class_status; ?>"><?= $status; ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>