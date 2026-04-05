<?php

// Data mahasiswa (array asosiatif)
$mahasiswa = [
    ["nama" => "Yoga Hogantara",    "nim" => "2311102153", "nilai_tugas" => 95, "nilai_uts" => 90, "nilai_uas" => 100],
    ["nama" => "Nadhif Atha Zaki",    "nim" => "2311102007", "nilai_tugas" => 50, "nilai_uts" => 55, "nilai_uas" => 52],
    ["nama" => "YHota",      "nim" => "231111123", "nilai_tugas" => 92, "nilai_uts" => 88, "nilai_uas" => 95],
    ["nama" => "donnngo",  "nim" => "2021004", "nilai_tugas" => 55, "nilai_uts" => 50, "nilai_uas" => 48],
];

// Function menghitung
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return round(($tugas * 0.30) + ($uts * 0.35) + ($uas * 0.35), 2);
}

// Function menentukan grade
function tentukanGrade($nilai) {
    if ($nilai >= 85)      return "A";
    elseif ($nilai >= 75)  return "B";
    elseif ($nilai >= 65)  return "C";
    elseif ($nilai >= 55)  return "D";
    else                   return "E";
}

$total = 0;
$tertinggi = 0;

foreach ($mahasiswa as &$mhs) {
    $mhs["nilai_akhir"] = hitungNilaiAkhir($mhs["nilai_tugas"], $mhs["nilai_uts"], $mhs["nilai_uas"]);
    $mhs["grade"]       = tentukanGrade($mhs["nilai_akhir"]);
    $mhs["status"]      = ($mhs["nilai_akhir"] >= 60) ? "Lulus" : "Tidak Lulus";

    $total += $mhs["nilai_akhir"];
    if ($mhs["nilai_akhir"] > $tertinggi) $tertinggi = $mhs["nilai_akhir"];
}

unset($mhs);
$rata_rata = round($total / count($mahasiswa), 2);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Penilaian Mahasiswa</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            padding: 20px; 
            background: #f4f4f4; 
        }
        h2 { 
            margin-bottom: 10px; 
        }
        table { 
            border-collapse: collapse; 
            width: 100%; background: white; 
        }
        th, td { 
            border: 1px solid #ccc; 
            padding: 10px; 
            text-align: center; }
        th { 
            background: #21252b; 
            color: white; 
        }
        tr:nth-child(even) { 
            background: #f0f0f0; 
        }
        .lulus { 
            color: green; 
            font-weight: bold; 
        }
        .tidak { 
            color: red;   
            font-weight: bold; 
        }
        .summary { 
            margin-top: 15px; 
            background: white; 
            padding: 12px 16px;
            border-left: 4px solid #21252b; 
            display: inline-block; 
        }
    </style>
</head>
<body>

<h2>Sistem Penilaian Mahasiswa</h2>
<p>Nilai Akhir = (Tugas × 30%) + (UTS × 35%) + (UAS × 35%)</p>

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
        <?php foreach ($mahasiswa as $i => $mhs): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= $mhs["nama"] ?></td>
            <td><?= $mhs["nim"] ?></td>
            <td><?= $mhs["nilai_tugas"] ?></td>
            <td><?= $mhs["nilai_uts"] ?></td>
            <td><?= $mhs["nilai_uas"] ?></td>
            <td><strong><?= $mhs["nilai_akhir"] ?></strong></td>
            <td><?= $mhs["grade"] ?></td>
            <td class="<?= $mhs["status"] === 'Lulus' ? 'lulus' : 'tidak' ?>">
                <?= $mhs["status"] ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="summary">
    <p><strong>Rata-rata Kelas :</strong> <?= $rata_rata ?></p>
    <p><strong>Nilai Tertinggi :</strong> <?= $tertinggi ?></p>
</div>

</body>
</html>