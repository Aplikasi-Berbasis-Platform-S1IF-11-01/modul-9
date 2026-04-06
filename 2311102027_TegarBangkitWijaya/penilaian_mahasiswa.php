<?php
// ============================================================
//  Sistem Penilaian Mahasiswa - Modul 9 PHP
// ============================================================

// --- Data Mahasiswa (Array Asosiatif) ------------------------
$mahasiswa = [
    [
        "nama"         => "Tegar Bangkit Wijaya",
        "nim"          => "2311102027",
        "nilai_tugas"  => 90,
        "nilai_uts"    => 85,
        "nilai_uas"    => 90,
    ],
    [
        "nama"         => "Annisa Al Jauhar",
        "nim"          => "2311102014",
        "nilai_tugas"  => 90,
        "nilai_uts"    => 85,
        "nilai_uas"    => 80,
    ],
    [
        "nama"         => "Rizal Dwi Anggoro",
        "nim"          => "2311102010",
        "nilai_tugas"  => 92,
        "nilai_uts"    => 88,
        "nilai_uas"    => 95,
    ],
    [
        "nama"         => "Didi Setiawan",
        "nim"          => "2311102015",
        "nilai_tugas"  => 55,
        "nilai_uts"    => 50,
        "nilai_uas"    => 48,
    ],
    [
        "nama"         => "mawang",
        "nim"          => "231110209",
        "nilai_tugas"  => 78,
        "nilai_uts"    => 80,
        "nilai_uas"    => 60,
    ],
];

// --- Function: Hitung Nilai Akhir ----------------------------
// Bobot: Tugas 30% | UTS 35% | UAS 35%
function hitungNilaiAkhir(float $tugas, float $uts, float $uas): float
{
    return ($tugas * 0.30) + ($uts * 0.35) + ($uas * 0.35);
}

// --- Function: Tentukan Grade --------------------------------
function tentukanGrade(float $nilaiAkhir): string
{
    if ($nilaiAkhir >= 85) {
        return "A";
    } elseif ($nilaiAkhir >= 75) {
        return "B";
    } elseif ($nilaiAkhir >= 65) {
        return "C";
    } elseif ($nilaiAkhir >= 55) {
        return "D";
    } else {
        return "E";
    }
}

// --- Function: Tentukan Status Kelulusan ---------------------
function tentukanStatus(float $nilaiAkhir): string
{
    return ($nilaiAkhir >= 60) ? "Lulus" : "Tidak Lulus";
}

// --- Hitung Nilai Akhir Setiap Mahasiswa ---------------------
$totalNilai   = 0;
$nilaiTertinggi = -1;
$mahasiswaTerbaik = "";

foreach ($mahasiswa as &$mhs) {
    $mhs["nilai_akhir"] = hitungNilaiAkhir(
        $mhs["nilai_tugas"],
        $mhs["nilai_uts"],
        $mhs["nilai_uas"]
    );
    $mhs["grade"]  = tentukanGrade($mhs["nilai_akhir"]);
    $mhs["status"] = tentukanStatus($mhs["nilai_akhir"]);

    // Akumulasi untuk rata-rata & nilai tertinggi
    $totalNilai += $mhs["nilai_akhir"];

    if ($mhs["nilai_akhir"] > $nilaiTertinggi) {
        $nilaiTertinggi   = $mhs["nilai_akhir"];
        $mahasiswaTerbaik = $mhs["nama"];
    }
}
unset($mhs); // Putus referensi

$jumlahMahasiswa = count($mahasiswa);
$rataRataKelas   = $totalNilai / $jumlahMahasiswa;

// --- Helper: warna badge grade -------------------------------
function gradeColor(string $grade): string
{
    return match ($grade) {
        "A"     => "#16a34a",   // hijau tua
        "B"     => "#2563eb",   // biru
        "C"     => "#d97706",   // amber
        "D"     => "#ea580c",   // oranye
        default => "#dc2626",   // merah
    };
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        /* ── Reset & Base ── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        /* ── Layout ── */
        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        /* ── Header ── */
        .header {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: #fff;
            border-radius: 16px;
            padding: 2rem 2.5rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1.25rem;
            box-shadow: 0 4px 24px rgba(30,58,138,.25);
        }
        .header-icon { font-size: 2.8rem; }
        .header h1  { font-size: 1.7rem; font-weight: 700; letter-spacing: -.5px; }
        .header p   { font-size: .9rem; opacity: .85; margin-top: .25rem; }

        /* ── Summary Cards ── */
        .summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .card {
            background: #fff;
            border-radius: 12px;
            padding: 1.4rem 1.6rem;
            box-shadow: 0 2px 10px rgba(0,0,0,.07);
            border-left: 5px solid var(--accent, #3b82f6);
        }
        .card .label { font-size: .78rem; text-transform: uppercase; letter-spacing: .05em; color: #64748b; }
        .card .value { font-size: 1.9rem; font-weight: 700; margin-top: .2rem; color: var(--accent, #1e293b); }
        .card .sub   { font-size: .82rem; color: #64748b; margin-top: .15rem; }

        /* ── Table ── */
        .table-wrapper {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(0,0,0,.08);
            overflow: hidden;
        }
        .table-title {
            padding: 1.2rem 1.8rem;
            font-weight: 700;
            font-size: 1rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead th {
            background: #1e3a8a;
            color: #fff;
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .07em;
            padding: .9rem 1rem;
            text-align: center;
        }
        thead th:first-child { text-align: left; }
        tbody tr { transition: background .15s; }
        tbody tr:nth-child(even) { background: #f8fafc; }
        tbody tr:hover           { background: #eff6ff; }
        td {
            padding: .85rem 1rem;
            font-size: .9rem;
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
        }
        td:first-child { text-align: left; }

        .nim-cell { color: #64748b; font-size: .82rem; font-family: monospace; }

        /* ── Name + highlight best ── */
        .student-name { font-weight: 600; }
        .best-student .student-name::after {
            content: " 🏆";
            font-size: .75rem;
        }

        /* ── Grade Badge ── */
        .badge-grade {
            display: inline-block;
            width: 2rem; height: 2rem;
            line-height: 2rem;
            border-radius: 50%;
            color: #fff;
            font-weight: 700;
            font-size: .85rem;
            text-align: center;
        }

        /* ── Status Pill ── */
        .pill {
            display: inline-block;
            padding: .25rem .85rem;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 600;
        }
        .pill.lulus       { background: #dcfce7; color: #15803d; }
        .pill.tidak-lulus { background: #fee2e2; color: #b91c1c; }

        /* ── Nilai Akhir ── */
        .nilai-akhir { font-weight: 700; font-size: 1rem; }

        /* ── Footer ── */
        .footer {
            text-align: center;
            margin-top: 2rem;
            font-size: .78rem;
            color: #94a3b8;
        }

        @media (max-width: 640px) {
            .header { flex-direction: column; text-align: center; }
            table   { font-size: .78rem; }
            td, thead th { padding: .65rem .5rem; }
        }
    </style>
</head>
<body>
<div class="container">

    <!-- ── Header ── -->
    <div class="header">
        <div class="header-icon">🎓</div>
        <div>
            <h1>Sistem Penilaian Mahasiswa</h1>
            <p>Modul 9 – PHP &nbsp;|&nbsp; Bobot: Tugas 30% &nbsp;·&nbsp; UTS 35% &nbsp;·&nbsp; UAS 35%</p>
        </div>
    </div>

    <!-- ── Summary Cards ── -->
    <div class="summary">
        <div class="card" style="--accent:#3b82f6">
            <div class="label">Total Mahasiswa</div>
            <div class="value"><?= $jumlahMahasiswa ?></div>
            <div class="sub">Terdaftar</div>
        </div>
        <div class="card" style="--accent:#16a34a">
            <div class="label">Rata-rata Kelas</div>
            <div class="value"><?= number_format($rataRataKelas, 1) ?></div>
            <div class="sub">Nilai Akhir</div>
        </div>
        <div class="card" style="--accent:#d97706">
            <div class="label">Nilai Tertinggi</div>
            <div class="value"><?= number_format($nilaiTertinggi, 1) ?></div>
            <div class="sub"><?= htmlspecialchars($mahasiswaTerbaik) ?></div>
        </div>
        <div class="card" style="--accent:#8b5cf6">
            <div class="label">Jumlah Lulus</div>
            <?php
                $lulusCount = count(array_filter($mahasiswa, fn($m) => $m["status"] === "Lulus"));
            ?>
            <div class="value"><?= $lulusCount ?></div>
            <div class="sub">dari <?= $jumlahMahasiswa ?> mahasiswa</div>
        </div>
    </div>

    <!-- ── Tabel ── -->
    <div class="table-wrapper">
        <div class="table-title">📋 Data Penilaian Mahasiswa</div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Mahasiswa</th>
                    <th>NIM</th>
                    <th>Tugas</th>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th>Nilai Akhir</th>
                    <th>Grade</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mahasiswa as $no => $mhs): ?>
                <?php
                    $isBest   = ($mhs["nilai_akhir"] == $nilaiTertinggi);
                    $rowClass = $isBest ? "best-student" : "";
                    $pillClass = ($mhs["status"] === "Lulus") ? "lulus" : "tidak-lulus";
                    $badgeBg   = gradeColor($mhs["grade"]);
                ?>
                <tr class="<?= $rowClass ?>">
                    <td><?= $no + 1 ?></td>
                    <td><span class="student-name"><?= htmlspecialchars($mhs["nama"]) ?></span></td>
                    <td><span class="nim-cell"><?= htmlspecialchars($mhs["nim"]) ?></span></td>
                    <td><?= $mhs["nilai_tugas"] ?></td>
                    <td><?= $mhs["nilai_uts"] ?></td>
                    <td><?= $mhs["nilai_uas"] ?></td>
                    <td><span class="nilai-akhir"><?= number_format($mhs["nilai_akhir"], 2) ?></span></td>
                    <td>
                        <span class="badge-grade" style="background:<?= $badgeBg ?>">
                            <?= $mhs["grade"] ?>
                        </span>
                    </td>
                    <td><span class="pill <?= $pillClass ?>"><?= $mhs["status"] ?></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- ── Keterangan Grade ── -->
    <div style="margin-top:1.5rem; background:#fff; border-radius:12px;
                padding:1.2rem 1.8rem; box-shadow:0 2px 10px rgba(0,0,0,.07);">
        <strong style="font-size:.85rem;">Keterangan Grade:</strong>
        <span style="font-size:.82rem; color:#475569; margin-left:.5rem;">
            <span style="color:#16a34a;font-weight:700;">A</span> ≥ 85 &nbsp;|&nbsp;
            <span style="color:#2563eb;font-weight:700;">B</span> 75–84 &nbsp;|&nbsp;
            <span style="color:#d97706;font-weight:700;">C</span> 65–74 &nbsp;|&nbsp;
            <span style="color:#ea580c;font-weight:700;">D</span> 55–64 &nbsp;|&nbsp;
            <span style="color:#dc2626;font-weight:700;">E</span> &lt; 55
            &nbsp;&nbsp;·&nbsp;&nbsp;
            Lulus jika Nilai Akhir ≥ 60
        </span>
    </div>

    <div class="footer">
        <p>Dibuat dengan PHP &nbsp;·&nbsp; Sistem Penilaian Mahasiswa © <?= date("Y") ?></p>
    </div>

</div>
</body>
</html>
