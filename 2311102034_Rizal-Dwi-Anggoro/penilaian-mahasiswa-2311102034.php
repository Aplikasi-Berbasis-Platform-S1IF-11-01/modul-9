<?php
// Logika tetap sama seperti sebelumnya
define('BOBOT_TUGAS', 0.30);
define('BOBOT_UTS', 0.35);
define('BOBOT_UAS', 0.35);

$mahasiswa = [
    ["nama" => "Rizal Dwi Anggoro", "nim" => "2311102034", "nilai_tugas" => 85, "nilai_uts" => 90, "nilai_uas" => 97],
    ["nama" => "Arjun Werdho Kumoro", "nim" => "23111009", "nilai_tugas" => 70, "nilai_uts" => 65, "nilai_uas" => 60],
    ["nama" => "Tegar Bangkit Wijaya",   "nim" => "231110207", "nilai_tugas" => 92, "nilai_uts" => 88, "nilai_uas" => 95],
    ["nama" => "Didik Setiawan", "nim" => "2311102037", "nilai_tugas" => 55, "nilai_uts" => 50, "nilai_uas" => 48],
    ["nama" => "Denny Budiansyach",   "nim" => "2311102008", "nilai_tugas" => 76, "nilai_uts" => 80, "nilai_uas" => 74],
];

function hitungNilaiAkhir(float $tugas, float $uts, float $uas): float {
    return ($tugas * BOBOT_TUGAS) + ($uts * BOBOT_UTS) + ($uas * BOBOT_UAS);
}

function tentukanGrade(float $nilai): string {
    return match (true) {
        $nilai >= 85 => "A",
        $nilai >= 75 => "B",
        $nilai >= 65 => "C",
        $nilai >= 55 => "D",
        default      => "E",
    };
}

$hasil = [];
$totalNilai = 0;
$nilaiTertinggi = -1;
$mhsTerbaik = "";

foreach ($mahasiswa as $mhs) {
    $akhir = hitungNilaiAkhir($mhs["nilai_tugas"], $mhs["nilai_uts"], $mhs["nilai_uas"]);
    $totalNilai += $akhir;
    if ($akhir > $nilaiTertinggi) {
        $nilaiTertinggi = $akhir;
        $mhsTerbaik = $mhs["nama"];
    }
    $hasil[] = array_merge($mhs, [
        "nilai_akhir" => round($akhir, 2),
        "grade"       => tentukanGrade($akhir),
        "status"      => ($akhir >= 60) ? "LULUS" : "GAGAL"
    ]);
}

$jumlahMhs = count($mahasiswa);
$rataRata  = $jumlahMhs > 0 ? round($totalNilai / $jumlahMhs, 2) : 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Akademik - Large View</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg: #f1f5f9;
            --card-bg: #ffffff;
            --primary: #2563eb;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border: #cbd5e1;
            --success: #10b981;
            --danger: #ef4444;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            padding: 3rem 1.5rem;
        }

        /* 1. Kontainer dibikin lebih lebar (1200px) */
        .container { max-width: 1200px; margin: 0 auto; }

        header { margin-bottom: 3.5rem; text-align: center; }
        /* 2. Judul diperbesar */
        header h1 { font-size: 2.8rem; font-weight: 800; letter-spacing: -0.03em; }
        header p { font-size: 1.1rem; color: var(--text-muted); margin-top: 0.7rem; }

        /* 3. Stat Cards lebih besar */
        .grid-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .stat-box {
            background: var(--card-bg);
            padding: 2.5rem 2rem;
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
        }

        .stat-label { font-size: 0.85rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.1em; }
        /* 4. Angka statistik diperbesar (3rem) */
        .stat-value { font-size: 3.2rem; font-weight: 800; margin-top: 0.5rem; color: var(--primary); line-height: 1; }
        .stat-sub { font-size: 1rem; color: var(--text-muted); margin-top: 0.5rem; font-weight: 500; }

        /* 5. Tabel dengan ukuran teks lebih nyaman */
        .table-container {
            background: var(--card-bg);
            border-radius: 16px;
            border: 1px solid var(--border);
            overflow-x: auto;
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05);
        }

        table { width: 100%; border-collapse: collapse; min-width: 900px; }
        th {
            background: #f8fafc;
            padding: 1.25rem 1.5rem;
            font-size: 0.85rem;
            text-transform: uppercase;
            font-weight: 800;
            color: var(--text-muted);
            border-bottom: 2px solid var(--border);
        }

        /* 6. Row padding ditambah agar lebih tinggi */
        td { padding: 1.5rem; border-top: 1px solid var(--border); font-size: 1.05rem; vertical-align: middle; }
        
        .mhs-info .name { font-size: 1.2rem; font-weight: 700; color: #1e293b; }
        .mhs-info .nim { font-size: 0.9rem; color: var(--text-muted); font-family: monospace; margin-top: 2px; }

        /* 7. Badge & Grade lebih besar */
        .badge {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 800;
            text-transform: uppercase;
        }
        .badge-success { background: #dcfce7; color: #15803d; }
        .badge-danger { background: #fee2e2; color: #b91c1c; }
        
        .grade-circle {
            width: 45px; height: 45px;
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 10px; font-weight: 800; font-size: 1.2rem;
        }

        .A { background: #dcfce7; color: #166534; box-shadow: 0 0 0 2px #bbf7d0; }
        .B { background: #dbeafe; color: #1e40af; box-shadow: 0 0 0 2px #bfdbfe; }
        .C { background: #fef9c3; color: #854d0e; box-shadow: 0 0 0 2px #fef08a; }
        .D { background: #ffedd5; color: #9a3412; box-shadow: 0 0 0 2px #fed7aa; }
        .E { background: #fee2e2; color: #991b1b; box-shadow: 0 0 0 2px #fecaca; }

        footer { text-align: center; margin-top: 4rem; font-size: 1rem; color: var(--text-muted); font-weight: 500; }
    </style>
</head>
<body>

    <div class="container">
        <header>
            <h1>Sistem Penilaian Akademik</h1>
            <p>Monitor Capaian Studi Mahasiswa Secara Real-Time</p>
        </header>

        <div class="grid-stats">
            <div class="stat-box">
                <div class="stat-label">Total Mahasiswa</div>
                <div class="stat-value"><?= $jumlahMhs ?></div>
                <div class="stat-sub">Data Terverifikasi</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Rata-rata Kelas</div>
                <div class="stat-value"><?= $rataRata ?></div>
                <div class="stat-sub">Standar Kompetensi</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">Capaian Tertinggi</div>
                <div class="stat-value" style="font-size: 2.8rem;"><?= $nilaiTertinggi ?></div>
                <div class="stat-sub"><?= htmlspecialchars($mhsTerbaik) ?></div>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Mahasiswa</th>
                        <th>Tugas</th>
                        <th>UTS</th>
                        <th>UAS</th>
                        <th>Nilai Akhir</th>
                        <th>Grade</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($hasil as $row): ?>
                    <tr>
                        <td class="mhs-info">
                            <div class="name"><?= htmlspecialchars($row['nama']) ?></div>
                            <div class="nim"><?= $row['nim'] ?></div>
                        </td>
                        <td><?= $row['nilai_tugas'] ?></td>
                        <td><?= $row['nilai_uts'] ?></td>
                        <td><?= $row['nilai_uas'] ?></td>
                        <td style="font-weight: 800; color: var(--primary); font-size: 1.2rem;"><?= $row['nilai_akhir'] ?></td>
                        <td><span class="grade-circle <?= $row['grade'] ?>"><?= $row['grade'] ?></span></td>
                        <td>
                            <span class="badge <?= $row['status'] === 'LULUS' ? 'badge-success' : 'badge-danger' ?>">
                                <?= $row['status'] ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <footer>
            &copy; <?= date("Y") ?> &bull; Dashboard Akademik Profesional
        </footer>
    </div>

</body>
</html>