<?php
$mahasiswa = [
    [
        "nama" => "Muhammad Hamzah Haifan Ma'ruf",
        "nim" => "2311102091",
        "tugas" => 98,
        "uts" => 100,
        "uas" => 95
    ],
    [
        "nama" => "Budi",
        "nim" => "002",
        "tugas" => 70,
        "uts" => 75,
        "uas" => 72
    ],
    [
        "nama" => "Citra",
        "nim" => "003",
        "tugas" => 90,
        "uts" => 88,
        "uas" => 95
    ]
];

function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

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

function tentukanStatus($nilai) {
    if ($nilai >= 75) {
        return "Lulus";
    } else {
        return "Tidak Lulus";
    }
}

$total = 0;
$nilaiTertinggi = 0;

foreach ($mahasiswa as $mhs) {
    $nilaiAkhir = hitungNilaiAkhir($mhs["tugas"], $mhs["uts"], $mhs["uas"]);
    $total += $nilaiAkhir;

    if ($nilaiAkhir > $nilaiTertinggi) {
        $nilaiTertinggi = $nilaiAkhir;
    }
}

$rataRata = $total / count($mahasiswa);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 10px;
            border: 1px solid black;
            text-align: center;
        }

        th {
            background: #333;
            color: white;
        }
    </style>
</head>
<body>

<h2>Sistem Penilaian Mahasiswa</h2>

<table>
<tr>
    <th>Nama</th>
    <th>NIM</th>
    <th>Nilai Akhir</th>
    <th>Grade</th>
    <th>Status</th>
</tr>

<?php foreach ($mahasiswa as $mhs): 
    $nilaiAkhir = hitungNilaiAkhir($mhs["tugas"], $mhs["uts"], $mhs["uas"]);
?>
<tr>
    <td><?= $mhs["nama"]; ?></td>
    <td><?= $mhs["nim"]; ?></td>
    <td><?= number_format($nilaiAkhir, 2); ?></td>
    <td><?= tentukanGrade($nilaiAkhir); ?></td>
    <td><?= tentukanStatus($nilaiAkhir); ?></td>
</tr>
<?php endforeach; ?>

</table>

<br>

<p><b>Rata-rata Kelas:</b> <?= number_format($rataRata, 2); ?></p>
<p><b>Nilai Tertinggi:</b> <?= number_format($nilaiTertinggi, 2); ?></p>

</body>
</html>