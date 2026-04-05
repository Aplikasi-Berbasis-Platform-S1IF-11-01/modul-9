//Andika Neviantoro
//2311102167

<?php
$mahasiswa = [
    [
        "nama"        => "Indra Pratama",
        "nim"         => "2311102228",
        "nilai_tugas" => 85,
        "nilai_uts"   => 78,
        "nilai_uas"   => 82,
    ],
    [
        "nama"        => "Setya Wibowo",
        "nim"         => "2311102312",
        "nilai_tugas" => 72,
        "nilai_uts"   => 65,
        "nilai_uas"   => 70,
    ],
    [
        "nama"        => "Andika Neviantoro",
        "nim"         => "2311102167",
        "nilai_tugas" => 90,
        "nilai_uts"   => 88,
        "nilai_uas"   => 92,
    ],
    [
        "nama"        => "Roni Subandi",
        "nim"         => "2311102133",
        "nilai_tugas" => 55,
        "nilai_uts"   => 50,
        "nilai_uas"   => 48,
    ],
    [
        "nama"        => "Eka Prasetya",
        "nim"         => "2311102111",
        "nilai_tugas" => 78,
        "nilai_uts"   => 80,
        "nilai_uas"   => 75,
    ],
    [
        "nama"        => "Fajar Nugroho",
        "nim"         => "2311102145",
        "nilai_tugas" => 80,
        "nilai_uts"   => 76,
        "nilai_uas"   => 79,
    ],
    [
        "nama"        => "Gilang Ramadhan",
        "nim"         => "2311102158",
        "nilai_tugas" => 65,
        "nilai_uts"   => 70,
        "nilai_uas"   => 68,
    ],
    [
        "nama"        => "Hendra Kusuma",
        "nim"         => "2311102174",
        "nilai_tugas" => 88,
        "nilai_uts"   => 85,
        "nilai_uas"   => 90,
    ],
    [
        "nama"        => "Irfan Hakim",
        "nim"         => "2311102189",
        "nilai_tugas" => 60,
        "nilai_uts"   => 58,
        "nilai_uas"   => 62,
    ],
    [
        "nama"        => "Joko Santoso",
        "nim"         => "2311102201",
        "nilai_tugas" => 75,
        "nilai_uts"   => 72,
        "nilai_uas"   => 74,
    ],
    [
        "nama"        => "Kevin Alfarizi",
        "nim"         => "2311102215",
        "nilai_tugas" => 92,
        "nilai_uts"   => 90,
        "nilai_uas"   => 88,
    ],
    [
        "nama"        => "Lutfi Hidayat",
        "nim"         => "2311102237",
        "nilai_tugas" => 50,
        "nilai_uts"   => 55,
        "nilai_uas"   => 52,
    ],
    [
        "nama"        => "Muhammad Rizki",
        "nim"         => "2311102249",
        "nilai_tugas" => 83,
        "nilai_uts"   => 79,
        "nilai_uas"   => 81,
    ],
    [
        "nama"        => "Nanda Saputra",
        "nim"         => "2311102263",
        "nilai_tugas" => 70,
        "nilai_uts"   => 68,
        "nilai_uas"   => 71,
    ],
    [
        "nama"        => "Oscar Firmansyah",
        "nim"         => "2311102278",
        "nilai_tugas" => 77,
        "nilai_uts"   => 80,
        "nilai_uas"   => 76,
    ],
];

// --- FUNCTION: Hitung Nilai Akhir ---
// Bobot: Tugas 30%, UTS 35%, UAS 35%
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return round(($tugas * 0.30) + ($uts * 0.35) + ($uas * 0.35), 2);
}

// --- FUNCTION: Tentukan Grade ---
function tentukanGrade($nilai) {
    if ($nilai >= 85) return "A";
    elseif ($nilai >= 75) return "B";
    elseif ($nilai >= 65) return "C";
    elseif ($nilai >= 55) return "D";
    else return "E";
}

// --- FUNCTION: Tentukan Status ---
function tentukanStatus($nilai) {
    return ($nilai >= 60) ? "Lulus" : "Tidak Lulus";
}

// --- PROSES DATA ---
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

$rata_rata_kelas = round($total_nilai / count($mahasiswa), 2);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Penilaian Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f4f4f4;
            color: #333;
        }

        h2 {
            margin-bottom: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px 14px;
            text-align: center;
        }

        th {
            background: #4a90d9;
            color: #fff;
        }

        tr:nth-child(even) {
            background: #f0f7ff;
        }

        .lulus {
            color: green;
            font-weight: bold;
        }

        .tidak-lulus {
            color: red;
            font-weight: bold;
        }

        .summary {
            margin-top: 20px;
            background: #fff;
            border: 1px solid #ccc;
            padding: 14px 18px;
            display: inline-block;
        }

        .summary p {
            margin: 4px 0;
        }
    </style>
</head>
<body>

<h2>Sistem Penilaian Mahasiswa</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
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
        <?php $no = 1; foreach ($mahasiswa as $mhs): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td style="text-align:left"><?= htmlspecialchars($mhs['nama']) ?></td>
            <td><?= $mhs['nim'] ?></td>
            <td><?= $mhs['nilai_tugas'] ?></td>
            <td><?= $mhs['nilai_uts'] ?></td>
            <td><?= $mhs['nilai_uas'] ?></td>
            <td><strong><?= $mhs['nilai_akhir'] ?></strong></td>
            <td><strong><?= $mhs['grade'] ?></strong></td>
            <td class="<?= $mhs['status'] === 'Lulus' ? 'lulus' : 'tidak-lulus' ?>">
                <?= $mhs['status'] ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="summary">
    <p><strong>Rata-rata Kelas :</strong> <?= $rata_rata_kelas ?></p>
    <p><strong>Nilai Tertinggi :</strong> <?= $nilai_tertinggi ?> (<?= $nama_tertinggi ?>)</p>
</div>

</body>
</html>