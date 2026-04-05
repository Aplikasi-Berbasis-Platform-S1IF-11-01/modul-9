<?php
/**
 * ============================================================
 *  MODUL 9 — Sistem Penilaian Mahasiswa
 * ============================================================
 *  Nama  : Azaria Nanda Putri
 *  NIM   : 2311102147
 *  Tujuan: Mengelola dan menampilkan nilai mahasiswa
 *          menggunakan PHP murni + HTML dalam 1 file
 * ============================================================
 */


// ============================================================
// 1. DATA MAHASISWA (Array Asosiatif)
// ============================================================
$mahasiswa = [
    [
        "nama"        => "Andi Firmansyah",
        "nim"         => "2311102101",
        "nilai_tugas" => 88,
        "nilai_uts"   => 78,
        "nilai_uas"   => 85,
    ],
    [
        "nama"        => "Bella Safitri",
        "nim"         => "2311102102",
        "nilai_tugas" => 95,
        "nilai_uts"   => 90,
        "nilai_uas"   => 93,
    ],
    [
        "nama"        => "Cahyo Nugroho",
        "nim"         => "2311102103",
        "nilai_tugas" => 60,
        "nilai_uts"   => 55,
        "nilai_uas"   => 58,
    ],
    [
        "nama"        => "Dina Maulida",
        "nim"         => "2311102104",
        "nilai_tugas" => 72,
        "nilai_uts"   => 68,
        "nilai_uas"   => 70,
    ],
    [
        "nama"        => "Eko Prasetyo",
        "nim"         => "2311102105",
        "nilai_tugas" => 40,
        "nilai_uts"   => 35,
        "nilai_uas"   => 42,
    ],
];


// ============================================================
// 2. FUNCTION: Hitung Nilai Akhir
//    Rumus: (Tugas × 30%) + (UTS × 30%) + (UAS × 40%)
// ============================================================
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);
}


// ============================================================
// 3. FUNCTION: Tentukan Grade Berdasarkan Nilai Akhir
//    A ≥ 85 | B ≥ 75 | C ≥ 65 | D ≥ 50 | E < 50
// ============================================================
function tentukanGrade($nilaiAkhir) {
    if ($nilaiAkhir >= 85) {
        return "A";
    } elseif ($nilaiAkhir >= 75) {
        return "B";
    } elseif ($nilaiAkhir >= 65) {
        return "C";
    } elseif ($nilaiAkhir >= 50) {
        return "D";
    } else {
        return "E";
    }
}


// ============================================================
// 4. FUNCTION: Tentukan Status Kelulusan
//    Lulus jika nilai akhir >= 60, selainnya Tidak Lulus
// ============================================================
function tentukanStatus($nilaiAkhir) {
    if ($nilaiAkhir >= 60) {
        return "Lulus";
    } else {
        return "Tidak Lulus";
    }
}


// ============================================================
// 5. PROSES DATA — Loop seluruh mahasiswa,
//    hitung nilai akhir, grade, dan status masing-masing
// ============================================================
$totalNilai     = 0;
$nilaiTertinggi = 0;
$namaTertinggi  = "";
$nimTertinggi   = "";

foreach ($mahasiswa as &$mhs) {
    // Hitung nilai akhir dengan memanggil function
    $mhs["nilai_akhir"] = hitungNilaiAkhir(
        $mhs["nilai_tugas"],
        $mhs["nilai_uts"],
        $mhs["nilai_uas"]
    );

    // Tentukan grade menggunakan operator perbandingan
    $mhs["grade"] = tentukanGrade($mhs["nilai_akhir"]);

    // Tentukan status lulus / tidak lulus
    $mhs["status"] = tentukanStatus($mhs["nilai_akhir"]);

    // Akumulasi nilai untuk menghitung rata-rata
    $totalNilai += $mhs["nilai_akhir"];

    // Cek apakah nilai ini adalah yang tertinggi sejauh ini
    if ($mhs["nilai_akhir"] > $nilaiTertinggi) {
        $nilaiTertinggi = $mhs["nilai_akhir"];
        $namaTertinggi  = $mhs["nama"];
        $nimTertinggi   = $mhs["nim"];
    }
}
unset($mhs); // Hapus referensi variabel setelah loop selesai

// Hitung rata-rata kelas
$jumlahMahasiswa = count($mahasiswa);
$rataRata        = $totalNilai / $jumlahMahasiswa;

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modul 9 — Sistem Penilaian Mahasiswa</title>
    <style>

        /* ========== RESET & FONT ========== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
            color: #1e293b;
            padding: 36px 20px 60px;
            min-height: 100vh;
        }

        /* ========== WRAPPER ========== */
        .wrapper {
            max-width: 960px;
            margin: 0 auto;
        }

        /* ========== HEADER ========== */
        .header {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: white;
            border-radius: 16px;
            padding: 32px 36px;
            margin-bottom: 28px;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 16px;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 6px;
            letter-spacing: -0.3px;
        }

        .header .subtitle {
            font-size: 13px;
            opacity: 0.75;
            margin-bottom: 2px;
        }

        .identity-box {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 10px;
            padding: 12px 18px;
            font-size: 13px;
            line-height: 1.8;
        }

        .identity-box .label {
            opacity: 0.7;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .identity-box .value {
            font-weight: 700;
        }

        /* Rumus di dalam header */
        .formula-strip {
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid rgba(255,255,255,0.15);
            font-size: 13px;
            opacity: 0.85;
        }

        .formula-strip strong {
            opacity: 1;
            font-weight: 700;
        }

        /* ========== STATISTIK ========== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        }

        .stat-card .stat-label {
            font-size: 11px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 8px;
        }

        .stat-card .stat-value {
            font-size: 30px;
            font-weight: 800;
            color: #1e3a8a;
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-card .stat-sub {
            font-size: 12px;
            color: #64748b;
        }

        /* ========== TABEL ========== */
        .table-section {
            background: white;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
            margin-bottom: 28px;
        }

        .table-header {
            padding: 18px 24px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-header .bar {
            width: 4px;
            height: 20px;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            border-radius: 2px;
            flex-shrink: 0;
        }

        .table-header h2 {
            font-size: 15px;
            font-weight: 700;
            color: #1e293b;
        }

        .table-header .count {
            margin-left: auto;
            font-size: 12px;
            color: #94a3b8;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 3px 10px;
            border-radius: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background: #f8fafc;
            padding: 12px 20px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border-bottom: 1px solid #f1f5f9;
        }

        /* Nomor urut rata tengah */
        thead th:first-child,
        tbody td:first-child {
            text-align: center;
            width: 52px;
        }

        tbody tr {
            border-bottom: 1px solid #f8fafc;
            transition: background 0.15s;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        tbody td {
            padding: 16px 20px;
            font-size: 14px;
            color: #475569;
        }

        .td-no {
            font-size: 12px;
            color: #cbd5e1;
            font-weight: 600;
        }

        .td-nama {
            font-weight: 700;
            color: #1e293b;
        }

        .td-nim {
            font-family: 'Courier New', monospace;
            font-size: 13px;
            color: #94a3b8;
        }

        .td-nilai {
            font-weight: 800;
            font-size: 15px;
            color: #1e3a8a;
        }

        /* ========== BADGE GRADE ========== */
        .grade-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 9px;
            font-weight: 800;
            font-size: 15px;
        }

        .grade-A { background: #dcfce7; color: #15803d; }
        .grade-B { background: #dbeafe; color: #1d4ed8; }
        .grade-C { background: #fef9c3; color: #854d0e; }
        .grade-D { background: #ffedd5; color: #c2410c; }
        .grade-E { background: #fee2e2; color: #b91c1c; }

        /* ========== BADGE STATUS ========== */
        .status-badge {
            display: inline-block;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .status-lulus {
            background: #dcfce7;
            color: #15803d;
        }

        .status-tidak {
            background: #fee2e2;
            color: #b91c1c;
        }

        /* ========== INFO NILAI TERTINGGI ========== */
        .highlight-box {
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            border: 1px solid #bfdbfe;
            border-radius: 12px;
            padding: 18px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 28px;
        }

        .highlight-icon {
            font-size: 32px;
            line-height: 1;
        }

        .highlight-text .hl-label {
            font-size: 11px;
            color: #2563eb;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 3px;
        }

        .highlight-text .hl-nama {
            font-size: 17px;
            font-weight: 800;
            color: #1e3a8a;
        }

        .highlight-text .hl-detail {
            font-size: 13px;
            color: #3b82f6;
            margin-top: 2px;
        }

        .highlight-nilai {
            margin-left: auto;
            text-align: right;
        }

        .highlight-nilai .hn-angka {
            font-size: 36px;
            font-weight: 900;
            color: #1e3a8a;
            line-height: 1;
        }

        .highlight-nilai .hn-label {
            font-size: 11px;
            color: #60a5fa;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ========== KETERANGAN GRADE ========== */
        .keterangan-section {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 18px 24px;
        }

        .keterangan-section h3 {
            font-size: 13px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        .keterangan-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .ket-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 13px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }

        .ket-grade {
            font-weight: 800;
            font-size: 14px;
            width: 20px;
            text-align: center;
        }

        .ket-range {
            color: #64748b;
            font-size: 12px;
        }

        /* ========== FOOTER ========== */
        .footer {
            text-align: center;
            margin-top: 32px;
            font-size: 12px;
            color: #cbd5e1;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 600px) {
            .stats-grid { grid-template-columns: 1fr; }
            .header-top { flex-direction: column; }
            .highlight-box { flex-wrap: wrap; }
        }

    </style>
</head>
<body>

<div class="wrapper">

    <!-- ======== HEADER ======== -->
    <div class="header">
        <div class="header-top">
            <div>
                <div class="subtitle">Praktikum Pemrograman Web — Modul 9</div>
                <h1>Sistem Penilaian Mahasiswa</h1>
                <div class="subtitle">Teknologi: PHP + HTML dalam 1 file</div>
            </div>
            <div class="identity-box">
                <div class="label">Nama Mahasiswa</div>
                <div class="value">Azaria Nanda Putri</div>
                <div class="label" style="margin-top:6px">NIM</div>
                <div class="value">2311102147</div>
            </div>
        </div>

        <!-- Rumus Nilai Akhir -->
        <div class="formula-strip">
            <strong>Rumus Nilai Akhir:</strong>
            &nbsp; (Tugas &times; 30%) &nbsp;+&nbsp; (UTS &times; 30%) &nbsp;+&nbsp; (UAS &times; 40%)
        </div>
    </div>


    <!-- ======== STATISTIK KELAS ======== -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total Mahasiswa</div>
            <div class="stat-value"><?= $jumlahMahasiswa ?></div>
            <div class="stat-sub">orang terdaftar</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Rata-rata Kelas</div>
            <div class="stat-value"><?= number_format($rataRata, 1) ?></div>
            <div class="stat-sub">dari skala 100</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Nilai Tertinggi</div>
            <div class="stat-value"><?= number_format($nilaiTertinggi, 1) ?></div>
            <div class="stat-sub"><?= htmlspecialchars($namaTertinggi) ?></div>
        </div>
    </div>


    <!-- ======== HIGHLIGHT: NILAI TERTINGGI ======== -->
    <div class="highlight-box">
        <div class="highlight-icon">🏆</div>
        <div class="highlight-text">
            <div class="hl-label">Peraih Nilai Tertinggi</div>
            <div class="hl-nama"><?= htmlspecialchars($namaTertinggi) ?></div>
            <div class="hl-detail">NIM: <?= htmlspecialchars($nimTertinggi) ?></div>
        </div>
        <div class="highlight-nilai">
            <div class="hn-angka"><?= number_format($nilaiTertinggi, 1) ?></div>
            <div class="hn-label">Nilai Akhir</div>
        </div>
    </div>


    <!-- ======== TABEL DATA MAHASISWA ======== -->
    <div class="table-section">
        <div class="table-header">
            <div class="bar"></div>
            <h2>Data Nilai Seluruh Mahasiswa</h2>
            <span class="count"><?= $jumlahMahasiswa ?> mahasiswa</span>
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
                <?php
                // ── Loop untuk menampilkan semua data mahasiswa ──
                $nomor = 1;
                foreach ($mahasiswa as $mhs):
                    // Pilih class CSS sesuai status
                    $statusClass = ($mhs["status"] === "Lulus") ? "status-lulus" : "status-tidak";
                    $gradeClass  = "grade-" . $mhs["grade"];
                ?>
                <tr>
                    <td class="td-no"><?= $nomor++ ?></td>
                    <td class="td-nama"><?= htmlspecialchars($mhs["nama"]) ?></td>
                    <td class="td-nim"><?= htmlspecialchars($mhs["nim"]) ?></td>
                    <td class="td-nilai"><?= number_format($mhs["nilai_akhir"], 2) ?></td>
                    <td>
                        <span class="grade-badge <?= $gradeClass ?>">
                            <?= $mhs["grade"] ?>
                        </span>
                    </td>
                    <td>
                        <span class="status-badge <?= $statusClass ?>">
                            <?= $mhs["status"] ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


    <!-- ======== KETERANGAN GRADE ======== -->
    <div class="keterangan-section">
        <h3>Keterangan Grade</h3>
        <div class="keterangan-grid">
            <div class="ket-item">
                <span class="ket-grade grade-badge grade-A" style="width:28px;height:28px;font-size:13px">A</span>
                <span class="ket-range">Nilai ≥ 85 — Sangat Baik</span>
            </div>
            <div class="ket-item">
                <span class="ket-grade grade-badge grade-B" style="width:28px;height:28px;font-size:13px">B</span>
                <span class="ket-range">Nilai ≥ 75 — Baik</span>
            </div>
            <div class="ket-item">
                <span class="ket-grade grade-badge grade-C" style="width:28px;height:28px;font-size:13px">C</span>
                <span class="ket-range">Nilai ≥ 65 — Cukup</span>
            </div>
            <div class="ket-item">
                <span class="ket-grade grade-badge grade-D" style="width:28px;height:28px;font-size:13px">D</span>
                <span class="ket-range">Nilai ≥ 50 — Kurang</span>
            </div>
            <div class="ket-item">
                <span class="ket-grade grade-badge grade-E" style="width:28px;height:28px;font-size:13px">E</span>
                <span class="ket-range">Nilai &lt; 50 — Tidak Lulus</span>
            </div>
        </div>
    </div>


    <!-- ======== FOOTER ======== -->
    <div class="footer">
        Praktikum Pemrograman Web &mdash; Modul 9 &mdash;
        Azaria Nanda Putri / 2311102147 &mdash;
        <?= date('Y') ?>
    </div>

</div><!-- end .wrapper -->

</body>
</html>
