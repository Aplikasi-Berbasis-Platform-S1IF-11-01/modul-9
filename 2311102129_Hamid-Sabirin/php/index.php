<?php
// Memuat file data dan fungsi secara modular
require_once 'data.php';
require_once 'functions.php';

$total_nilai_kelas = 0;
$nilai_tertinggi = 0;

// Kalkulasi nilai untuk setiap mahasiswa
foreach ($mahasiswa as $key => $mhs) {
    $na = hitungNilaiAkhir($mhs['nilai_tugas'], $mhs['nilai_uts'], $mhs['nilai_uas']);
    $mahasiswa[$key]['nilai_akhir'] = $na;
    $mahasiswa[$key]['grade'] = tentukanGrade($na);
    $mahasiswa[$key]['status'] = tentukanStatus($na);

    $total_nilai_kelas += $na;
    if ($na > $nilai_tertinggi) {
        $nilai_tertinggi = $na;
    }
}

$rata_rata_kelas = count($mahasiswa) > 0 ? $total_nilai_kelas / count($mahasiswa) : 0;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    <!-- Menggunakan Bootstrap 5 untuk tampilan dasar yang rapi -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menggunakan Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Link ke file style.css eksternal -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-custom mb-4">
        <div class="container">
            <span class="navbar-brand">
                <i class="fa-solid fa-graduation-cap me-2"></i>2311102129-HAMID SABIRI
            </span>
        </div>
    </nav>

    <div class="container">
        <!-- Header Info -->
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h2 class="fw-bold mb-1">Capaian Akademik</h2>
                <p class="text-muted">Sistem rekapitulasi nilai akhir mahasiswa.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="d-inline-flex gap-2">
                    <button class="btn btn-primary shadow-sm"
                        style="background-color: var(--primary); border: none; border-radius: 8px;">
                        <i class="fa-solid fa-download me-2"></i> Ekspor Report
                    </button>
                </div>
            </div>
        </div>

        <!-- Statistik -->
        <div class="row g-4 mb-2">
            <!-- Rata-rata Kelas -->
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon icon-blue">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <div class="stat-title">Rata-Rata Kelas</div>
                    <div class="stat-value"><?php echo number_format($rata_rata_kelas, 2); ?></div>
                </div>
            </div>

            <!-- Nilai Tertinggi -->
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon icon-green">
                        <i class="fa-solid fa-trophy"></i>
                    </div>
                    <div class="stat-title">Nilai Tertinggi</div>
                    <div class="stat-value"><?php echo number_format($nilai_tertinggi, 2); ?></div>
                </div>
            </div>

            <!-- Total Mahasiswa -->
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon icon-purple">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="stat-title">Total Mahasiswa</div>
                    <div class="stat-value"><?php echo count($mahasiswa); ?></div>
                </div>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="table-card">
            <div class="table-header">
                <h3 class="table-title">Daftar Nilai Mahasiswa</h3>
                <span class="badge bg-light text-dark border"><i class="fa-solid fa-filter me-1"></i> Filter</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 25%">Mahasiswa</th>
                            <th style="width: 15%">NIM</th>
                            <th style="width: 15%" class="text-center">Nilai Akhir</th>
                            <th style="width: 15%" class="text-center">Grade</th>
                            <th style="width: 15%" class="text-center">Status</th>
                            <th style="width: 10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        // Loop menggunakan foreach untuk menampilkan baris data
                        foreach ($mahasiswa as $mhs) :
                            // Get initials for avatar
                            $initials = strtoupper(substr($mhs['nama'], 0, 1));
                        ?>
                            <tr>
                                <td class="text-muted fw-bold"><?php echo $no++; ?></td>
                                <td>
                                    <div class="student-info">
                                        <div class="avatar"><?php echo $initials; ?></div>
                                        <div>
                                            <div class="fw-bold"><?php echo htmlspecialchars($mhs['nama']); ?></div>
                                            <div class="text-muted small">Tugas: <?php echo $mhs['nilai_tugas']; ?> | UTS:
                                                <?php echo $mhs['nilai_uts']; ?> | UAS: <?php echo $mhs['nilai_uas']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="font-monospace text-muted"><?php echo htmlspecialchars($mhs['nim']); ?></span>
                                </td>
                                <td class="text-center">
                                    <span class="fw-bold fs-5"><?php echo number_format($mhs['nilai_akhir'], 2); ?></span>
                                </td>
                                <td class="text-center">
                                    <span class="grade-badge grade-<?php echo $mhs['grade']; ?>">
                                        <?php echo $mhs['grade']; ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <?php if ($mhs['status'] == "Lulus") : ?>
                                        <span class="badge badge-custom badge-lulus"><i
                                                class="fa-solid fa-check-circle me-1"></i> LULUS</span>
                                    <?php else : ?>
                                        <span class="badge badge-custom badge-gagal"><i
                                                class="fa-solid fa-xmark-circle me-1"></i> GAGAL</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-light border" title="Detail"><i
                                            class="fa-solid fa-ellipsis"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>