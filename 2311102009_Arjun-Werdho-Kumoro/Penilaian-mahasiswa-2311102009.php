<?php
define('BOBOT_TUGAS', 0.30);
define('BOBOT_UTS', 0.35);
define('BOBOT_UAS', 0.35);

// Data Mahasiswa (10 orang)
$mahasiswa = [
    ["nama" => "Arjun Werdho Kumoro", "nim" => "2311102009", "nilai_tugas" => 70, "nilai_uts" => 65, "nilai_uas" => 60],
    ["nama" => "Raka Pratama", "nim" => "2311102002", "nilai_tugas" => 85, "nilai_uts" => 80, "nilai_uas" => 88],
    ["nama" => "Dimas Saputra", "nim" => "2311102003", "nilai_tugas" => 78, "nilai_uts" => 75, "nilai_uas" => 72],
    ["nama" => "Fajar Nugroho", "nim" => "2311102004", "nilai_tugas" => 90, "nilai_uts" => 92, "nilai_uas" => 95],
    ["nama" => "Rizky Ramadhan", "nim" => "2311102005", "nilai_tugas" => 60, "nilai_uts" => 58, "nilai_uas" => 62],
    ["nama" => "Bagas Setiawan", "nim" => "2311102006", "nilai_tugas" => 88, "nilai_uts" => 84, "nilai_uas" => 86],
    ["nama" => "Agus Salim", "nim" => "2311102007", "nilai_tugas" => 55, "nilai_uts" => 50, "nilai_uas" => 52],
    ["nama" => "Ilham Maulana", "nim" => "2311102008", "nilai_tugas" => 82, "nilai_uts" => 78, "nilai_uas" => 80],
    ["nama" => "Yusuf Hidayat", "nim" => "2311102009", "nilai_tugas" => 76, "nilai_uts" => 74, "nilai_uas" => 79],
    ["nama" => "Farhan Akbar", "nim" => "2311102010", "nilai_tugas" => 92, "nilai_uts" => 90, "nilai_uas" => 94],
];

function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * BOBOT_TUGAS) + ($uts * BOBOT_UTS) + ($uas * BOBOT_UAS);
}

function tentukanGrade($nilai) {
    if ($nilai >= 85) return "A";
    elseif ($nilai >= 75) return "B";
    elseif ($nilai >= 65) return "C";
    elseif ($nilai >= 55) return "D";
    else return "E";
}

$totalNilai = 0;
$nilaiTertinggi = 0;
$mhsTerbaik = "";

$hasil = [];

foreach ($mahasiswa as $mhs) {
    $akhir = hitungNilaiAkhir($mhs["nilai_tugas"], $mhs["nilai_uts"], $mhs["nilai_uas"]);
    $totalNilai += $akhir;

    if ($akhir > $nilaiTertinggi) {
        $nilaiTertinggi = $akhir;
        $mhsTerbaik = $mhs["nama"];
    }

    $hasil[] = [
        "nama" => $mhs["nama"],
        "nim" => $mhs["nim"],
        "tugas" => $mhs["nilai_tugas"],
        "uts" => $mhs["nilai_uts"],
        "uas" => $mhs["nilai_uas"],
        "akhir" => round($akhir, 2),
        "grade" => tentukanGrade($akhir),
        "status" => ($akhir >= 60) ? "LULUS" : "TIDAK LULUS"
    ];
}

$rataRata = round($totalNilai / count($mahasiswa), 2);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        body {
            font-family: Arial;
            background: #eef2f7;
            padding: 20px;
        }
        .container {
            max-width: 1100px;
            margin: auto;
        }
        h1 {
            text-align: center;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
            text-align: center;
        }
        th {
            background: #333;
            color: white;
        }
        .lulus {
            color: green;
            font-weight: bold;
        }
        .tidak {
            color: red;
            font-weight: bold;
        }
        .stats {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Sistem Penilaian Mahasiswa</h1>

    <div class="card stats">
        <div>Total Mahasiswa: <b><?= count($mahasiswa) ?></b></div>
        <div>Rata-rata: <b><?= $rataRata ?></b></div>
        <div>Tertinggi: <b><?= $nilaiTertinggi ?> (<?= $mhsTerbaik ?>)</b></div>
    </div>

    <div class="card">
        <table>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Tugas</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Nilai Akhir</th>
                <th>Grade</th>
                <th>Status</th>
            </tr>

            <?php foreach ($hasil as $h): ?>
            <tr>
                <td><?= $h["nama"] ?></td>
                <td><?= $h["nim"] ?></td>
                <td><?= $h["tugas"] ?></td>
                <td><?= $h["uts"] ?></td>
                <td><?= $h["uas"] ?></td>
                <td><?= $h["akhir"] ?></td>
                <td><?= $h["grade"] ?></td>
                <td class="<?= $h["status"] == "LULUS" ? "lulus" : "tidak" ?>">
                    <?= $h["status"] ?>
                </td>
            </tr>
            <?php endforeach; ?>

        </table>
    </div>
</div>

</body>
</html>