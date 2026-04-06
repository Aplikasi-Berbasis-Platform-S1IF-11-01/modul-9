<?php
/**
 * TUGAS MODUL 9 - SISTEM PENILAIAN MAHASISWA
 * Fitur: Array Asosiasi, Function, Perhitungan Nilai, Penentuan Grade & Status, Statistik.
 */

// 1. Data Mahasiswa (Array Asosiasi)
$mahasiswa = [
    [
        "nama" => "Satrio Wibowo",
        "nim" => "2311102149",
        "tugas" => 85,
        "uts" => 80,
        "uas" => 90
    ],
    [
        "nama" => "Yoga Hogantara",
        "nim" => "2311102153",
        "tugas" => 70,
        "uts" => 75,
        "uas" => 65
    ],
    [
        "nama" => "Avrizal Setyo Aji Nugroho",
        "nim" => "2311102145",
        "tugas" => 95,
        "uts" => 88,
        "uas" => 92
    ],
    [
        "nama" => "Hizkia Kevin Octaviano",
        "nim" => "2311102183",
        "tugas" => 55,
        "uts" => 60,
        "uas" => 58
    ]
];

// 2. Function Menghitung Nilai Akhir (Operator Aritmatika)
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

// 3. Function Penentuan Grade (If/Else)
function tentukanGrade($nilai) {
    if ($nilai >= 85) return "A";
    elseif ($nilai >= 75) return "B";
    elseif ($nilai >= 65) return "C";
    elseif ($nilai >= 50) return "D";
    else return "E";
}

// 4. Function Status Kelulusan (Operator Perbandingan)
function tentukanStatus($nilai) {
    return ($nilai >= 65) ? "Lulus" : "Tidak Lulus";
}

// Variabel bantu untuk statistik
$totalNilai = 0;
$nilaiTertinggi = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        /* CSS untuk Layout Tengah */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .card {
            background: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 900px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            font-weight: 600;
        }

        /* Styling Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        th {
            background-color: #3498db;
            color: white;
            padding: 15px;
            text-align: left;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid #ecf0f1;
            color: #34495e;
        }

        tr:hover {
            background-color: #f9fbff;
        }

        /* Status Badge */
        .badge {
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .lulus {
            background-color: #d4edda;
            color: #155724;
        }

        .gagal {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Statistik Section */
        .footer-stats {
            display: flex;
            justify-content: space-between;
            background: #2c3e50;
            color: white;
            padding: 20px;
            border-radius: 10px;
        }

        .stat-item {
            text-align: center;
            flex: 1;
        }

        .stat-item small {
            display: block;
            font-size: 0.75rem;
            color: #bdc3c7;
            margin-bottom: 5px;
        }

        .stat-item span {
            font-size: 1.2rem;
            font-weight: bold;
            color: #3498db;
        }

        .stat-divider {
            width: 1px;
            background: #455a64;
            margin: 0 15px;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Sistem Penilaian Mahasiswa</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Mahasiswa</th>
                <th>NIM</th>
                <th>Nilai Akhir</th>
                <th>Grade</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // 5. Loop untuk menampilkan data (Foreach)
            foreach ($mahasiswa as $index => $mhs) : 
                $n_akhir = hitungNilaiAkhir($mhs['tugas'], $mhs['uts'], $mhs['uas']);
                $grade = tentukanGrade($n_akhir);
                $status = tentukanStatus($n_akhir);

                // Hitung statistik
                $totalNilai += $n_akhir;
                if ($n_akhir > $nilaiTertinggi) $nilaiTertinggi = $n_akhir;
            ?>
            <tr>
                <td><?= $index + 1; ?></td>
                <td><strong><?= $mhs['nama']; ?></strong></td>
                <td><code><?= $mhs['nim']; ?></code></td>
                <td><?= number_format($n_akhir, 1); ?></td>
                <td><strong><?= $grade; ?></strong></td>
                <td>
                    <span class="badge <?= ($status == 'Lulus') ? 'lulus' : 'gagal'; ?>">
                        <?= $status; ?>
                    </span>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php 
    // Hitung rata-rata
    $rataRata = $totalNilai / count($mahasiswa);
    ?>

    <div class="footer-stats">
        <div class="stat-item">
            <small>RATA-RATA KELAS</small>
            <span><?= number_format($rataRata, 2); ?></span>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item">
            <small>NILAI TERTINGGI</small>
            <span><?= number_format($nilaiTertinggi, 2); ?></span>
        </div>
        <div class="stat-divider"></div>
        <div class="stat-item">
            <small>TOTAL MAHASISWA</small>
            <span><?= count($mahasiswa); ?></span>
        </div>
    </div>
</div>

</body>
</html>