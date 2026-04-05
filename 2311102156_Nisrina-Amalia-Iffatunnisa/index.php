<?php
include 'functions.php';

// Array Asosiasi Data Mahasiswa
$mahasiswa = [
    ["nama" => "Ahmad Rifai", "nim" => "22102001", "tugas" => 85, "uts" => 80, "uas" => 90],
    ["nama" => "Siti Aminah", "nim" => "22102002", "tugas" => 90, "uts" => 85, "uas" => 88],
    ["nama" => "Budi Santoso", "nim" => "22102003", "tugas" => 55, "uts" => 60, "uas" => 50],
    ["nama" => "Nisrina Amalia", "nim" => "2311102156", "tugas" => 95, "uts" => 92, "uas" => 94]
];

// Inisialisasi variabel untuk statistik
$totalNilai = 0;
$nilaiTertinggi = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-white header-title">Tugas Modul 9 - PHP</h1>
        <p class="text-secondary">Sistem Penilaian Mahasiswa Terintegrasi</p>
        <div class="header-line"></div>
    </div>
    <div class="card main-card border-0 shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0">
                    <thead>
                        <tr>
                            <th>MAHASISWA & NIM</th>
                            <th>NILAI (Tugas/UTS/UAS)</th>
                            <th>NILAI AKHIR</th>
                            <th>GRADE</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mahasiswa as $mhs) : 
                            $na = hitungNilaiAkhir($mhs['tugas'], $mhs['uts'], $mhs['uas']);
                            $grade = tentukanGrade($na);
                            $status = cekKelulusan($na);
                            
                            // Update statistik
                            $totalNilai += $na;
                            if ($na > $nilaiTertinggi) $nilaiTertinggi = $na;
                        ?>
                        <tr>
                            <td>
                                <div class="fw-bold"><?= $mhs['nama'] ?></div>
                                <small class="text-secondary"><?= $mhs['nim'] ?></small>
                            </td>
                            <td>
                                <span class="text-info"><?= $mhs['tugas'] ?></span> / 
                                <span class="text-info"><?= $mhs['uts'] ?></span> / 
                                <span class="text-info"><?= $mhs['uas'] ?></span>
                            </td>
                            <td class="fw-bold"><?= number_format($na, 1) ?></td>
                            <td><span class="grade-circle"><?= $grade ?></span></td>
                            <td>
                                <span class="badge <?= getStatusBadge($status) ?>">
                                    <?= $status ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card stat-card bg-dark text-white border-0 p-3 mb-3">
                <small class="text-secondary">Rata-rata Kelas</small>
                <h3 class="fw-bold text-primary"><?= number_format($totalNilai / count($mahasiswa), 1) ?></h3>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card stat-card bg-dark text-white border-0 p-3 mb-3">
                <small class="text-secondary">Nilai Tertinggi</small>
                <h3 class="fw-bold text-success"><?= number_format($nilaiTertinggi, 1) ?></h3>
            </div>
        </div>
    </div>
</div>

</body>
</html>