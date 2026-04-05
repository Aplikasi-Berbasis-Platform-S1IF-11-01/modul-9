<?php
// DATA MAHASISWA
$mahasiswa = [
    [
        "nama"        => "Reli Gita Nurhidayati",
        "nim"         => "2311102025",
        "nilai_tugas" => 88,
        "nilai_uts"   => 90,
        "nilai_uas"   => 92,
    ],
    [
        "nama"        => "Budi Setiawan",
        "nim"         => "2311102026",
        "nilai_tugas" => 75,
        "nilai_uts"   => 70,
        "nilai_uas"   => 68,
    ],
    [
        "nama"        => "Siti Aminah",
        "nim"         => "2311102027",
        "nilai_tugas" => 60,
        "nilai_uts"   => 55,
        "nilai_uas"   => 58,
    ],
];

// FUNCTION HITUNG NILAI AKHIR
function hitungNilaiAkhir($tugas, $uts, $uas) {
    $nilai_akhir = ($tugas * 0.30) + ($uts * 0.35) + ($uas * 0.35);
    return round($nilai_akhir, 2);
}

// FUNCTION TENTUKAN GRADE
function tentukanGrade($nilai) {
    if ($nilai >= 85) {
        return "A";
    } elseif ($nilai >= 75) {
        return "B";
    } elseif ($nilai >= 65) {
        return "C";
    } elseif ($nilai >= 50) {
        return "D";
    } else {
        return "E";
    }
}

// FUNCTION TENTUKAN STATUS
function tentukanStatus($nilai) {
    if ($nilai >= 65) {
        return "LULUS";
    } else {
        return "TIDAK LULUS";
    }
}

// PROSES DATA DENGAN LOOP
$total_nilai     = 0;
$nilai_tertinggi = 0;
$nama_tertinggi  = "";

foreach ($mahasiswa as &$mhs) {
    $na = hitungNilaiAkhir($mhs["nilai_tugas"], $mhs["nilai_uts"], $mhs["nilai_uas"]);
    $mhs["nilai_akhir"] = $na;
    $mhs["grade"]       = tentukanGrade($na);
    $mhs["status"]      = tentukanStatus($na);
    $total_nilai += $na;
    if ($na > $nilai_tertinggi) {
        $nilai_tertinggi = $na;
        $nama_tertinggi  = $mhs["nama"];
    }
}
unset($mhs);

$jumlah    = count($mahasiswa);
$rata_rata = round($total_nilai / $jumlah, 2);

$lulus = 0;
foreach ($mahasiswa as $m) {
    if ($m["status"] === "LULUS") $lulus++;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f0faf5;
            min-height: 100vh;
            padding: 40px 24px;
        }

        .container { max-width: 1000px; margin: 0 auto; }

        /* Header */
        .header {
            background: linear-gradient(135deg, #0f9b72 0%, #00c9a7 100%);
            border-radius: 20px;
            padding: 36px 40px;
            margin-bottom: 28px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .header::before {
            content: "";
            position: absolute;
            width: 200px; height: 200px;
            background: rgba(255,255,255,0.07);
            border-radius: 50%;
            right: -40px; top: -60px;
        }
        .header::after {
            content: "";
            position: absolute;
            width: 120px; height: 120px;
            background: rgba(255,255,255,0.07);
            border-radius: 50%;
            right: 80px; bottom: -40px;
        }
        .header .label {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            opacity: 0.85;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 32px;
            font-weight: 800;
            position: relative;
            z-index: 1;
        }
        .header p {
            margin-top: 8px;
            opacity: 0.8;
            font-size: 14px;
            position: relative;
            z-index: 1;
        }

        /* Stat Cards */
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }
        .card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
            border-top: 4px solid #0f9b72;
        }
        .card.gold  { border-color: #f59e0b; }
        .card.green { border-color: #10b981; }
        .card-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #9ca3af;
            margin-bottom: 10px;
        }
        .card-value { font-size: 36px; font-weight: 800; color: #1f2937; }
        .card-sub   { font-size: 13px; color: #6b7280; margin-top: 6px; }

        /* Table */
        .table-wrap {
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .table-head {
            padding: 20px 24px;
            border-bottom: 1px solid #f3f4f6;
            font-weight: 700;
            font-size: 16px;
            color: #1f2937;
        }
        table { width: 100%; border-collapse: collapse; }
        thead tr { background: #f9fafb; }
        th {
            padding: 14px 16px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #9ca3af;
            text-align: center;
        }
        td {
            padding: 16px;
            text-align: center;
            border-top: 1px solid #f3f4f6;
            font-size: 14px;
            color: #374151;
        }
        tbody tr:hover { background: #f0faf5; }

        .nim  { color: #9ca3af; font-size: 13px; }
        .nama { font-weight: 600; color: #1f2937; text-align: left; }

        .grade {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px; height: 34px;
            border-radius: 8px;
            font-weight: 800;
            font-size: 16px;
        }
        .grade-A { background: #d1fae5; color: #065f46; }
        .grade-B { background: #dbeafe; color: #1e40af; }
        .grade-C { background: #fef9c3; color: #854d0e; }
        .grade-D { background: #ffedd5; color: #9a3412; }
        .grade-E { background: #fee2e2; color: #991b1b; }

        .status {
            display: inline-block;
            padding: 5px 14px;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 700;
        }
        .lulus       { background: #d1fae5; color: #065f46; }
        .tidak-lulus { background: #fee2e2; color: #991b1b; }

        .nilai-akhir { font-weight: 700; font-size: 15px; color: #0f9b72; }

        .note {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="header">
        <div class="label">Tugas Modul 9 · Praktikum ABP</div>
        <h1>Sistem Penilaian Mahasiswa</h1>
        <p>Semester 6 · <?= date("d F Y") ?></p>
    </div>

    <div class="stats">
        <div class="card">
            <div class="card-label">Rata-rata Kelas</div>
            <div class="card-value"><?= $rata_rata ?></div>
            <div class="card-sub">dari <?= $jumlah ?> mahasiswa</div>
        </div>
        <div class="card gold">
            <div class="card-label">Nilai Tertinggi</div>
            <div class="card-value"><?= $nilai_tertinggi ?></div>
            <div class="card-sub"><?= htmlspecialchars($nama_tertinggi) ?></div>
        </div>
        <div class="card green">
            <div class="card-label">Kelulusan</div>
            <div class="card-value"><?= $lulus ?>/<?= $jumlah ?></div>
            <div class="card-sub"><?= $jumlah - $lulus ?> tidak lulus</div>
        </div>
    </div>

    <div class="table-wrap">
        <div class="table-head">📊 Rekap Nilai Mahasiswa</div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th style="text-align:left">Nama</th>
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
                <?php foreach ($mahasiswa as $i => $mhs) : ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td class="nama"><?= htmlspecialchars($mhs['nama']) ?></td>
                    <td class="nim"><?= $mhs['nim'] ?></td>
                    <td><?= $mhs['nilai_tugas'] ?></td>
                    <td><?= $mhs['nilai_uts'] ?></td>
                    <td><?= $mhs['nilai_uas'] ?></td>
                    <td class="nilai-akhir"><?= $mhs['nilai_akhir'] ?></td>
                    <td><span class="grade grade-<?= $mhs['grade'] ?>"><?= $mhs['grade'] ?></span></td>
                    <td>
                        <?php if ($mhs['status'] === 'LULUS') : ?>
                            <span class="status lulus">✓ Lulus</span>
                        <?php else : ?>
                            <span class="status tidak-lulus">✗ Tidak Lulus</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <p class="note">Rumus Nilai Akhir: (Tugas × 30%) + (UTS × 35%) + (UAS × 35%) &nbsp;|&nbsp; Lulus jika Nilai Akhir ≥ 65</p>

</div>
</body>
</html>
