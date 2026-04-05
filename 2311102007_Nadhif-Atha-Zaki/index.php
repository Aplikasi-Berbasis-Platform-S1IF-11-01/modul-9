<?php

$mahasiswa = [
    [
        "nama" => "Yoga Yhota",
        "nim" => "2311102034",
        "nilai_tugas" => 85,
        "nilai_uts" => 78,
        "nilai_uas" => 20
    ],
    [
        "nama" => "Nadhif Atha Zaki",
        "nim" => "2311102007",
        "nilai_tugas" => 100,
        "nilai_uts" => 100,
        "nilai_uas" => 100
    ],
    [
        "nama" => "Raihan Wangsaf",
        "nim" => "2311102003",
        "nilai_tugas" => 10,
        "nilai_uts" => 5,
        "nilai_uas" => 5
    ]
];

// Function untuk menghitung nilai akhir
function hitungNilaiAkhir($tugas, $uts, $uas)
{
    // Bobot: tugas 30%, UTS 30%, UAS 40%
    return ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);
}

// Function untuk menentukan grade
function tentukanGrade($nilaiAkhir)
{
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

// Function untuk menentukan status kelulusan
function tentukanStatus($nilaiAkhir)
{
    if ($nilaiAkhir >= 65) {
        return "Lulus";
    } else {
        return "Tidak Lulus";
    }
}

// Variabel untuk rata-rata dan nilai tertinggi
$totalNilai = 0;
$nilaiTertinggi = 0;
$mahasiswaTertinggi = "";

// Proses data mahasiswa
foreach ($mahasiswa as $key => $mhs) {
    $nilaiAkhir = hitungNilaiAkhir($mhs["nilai_tugas"], $mhs["nilai_uts"], $mhs["nilai_uas"]);
    $grade = tentukanGrade($nilaiAkhir);
    $status = tentukanStatus($nilaiAkhir);

    // Simpan hasil ke array
    $mahasiswa[$key]["nilai_akhir"] = $nilaiAkhir;
    $mahasiswa[$key]["grade"] = $grade;
    $mahasiswa[$key]["status"] = $status;

    // Hitung total untuk rata-rata
    $totalNilai += $nilaiAkhir;

    // Cari nilai tertinggi
    if ($nilaiAkhir > $nilaiTertinggi) {
        $nilaiTertinggi = $nilaiAkhir;
        $mahasiswaTertinggi = $mhs["nama"];
    }
}

// Hitung rata-rata kelas
$rataRataKelas = $totalNilai / count($mahasiswa);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 20px;
        }

        h2, h3 {
            text-align: center;
            color: #333;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .info {
            width: 90%;
            margin: 20px auto;
            background: #fff;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-left: 5px solid #007bff;
        }

        .lulus {
            color: green;
            font-weight: bold;
        }

        .tidak-lulus {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h2>Sistem Penilaian Mahasiswa</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Nilai Tugas</th>
            <th>Nilai UTS</th>
            <th>Nilai UAS</th>
            <th>Nilai Akhir</th>
            <th>Grade</th>
            <th>Status</th>
        </tr>

        <?php foreach ($mahasiswa as $index => $mhs): ?>
        <tr>
            <td><?= $index + 1; ?></td>
            <td><?= $mhs["nama"]; ?></td>
            <td><?= $mhs["nim"]; ?></td>
            <td><?= $mhs["nilai_tugas"]; ?></td>
            <td><?= $mhs["nilai_uts"]; ?></td>
            <td><?= $mhs["nilai_uas"]; ?></td>
            <td><?= number_format($mhs["nilai_akhir"], 2); ?></td>
            <td><?= $mhs["grade"]; ?></td>
            <td class="<?= ($mhs["status"] == 'Lulus') ? 'lulus' : 'tidak-lulus'; ?>">
                <?= $mhs["status"]; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <div class="info">
        <h3>Ringkasan Nilai</h3>
        <p><strong>Rata-rata Kelas:</strong> <?= number_format($rataRataKelas, 2); ?></p>
        <p><strong>Nilai Tertinggi:</strong> <?= number_format($nilaiTertinggi, 2); ?> (<?= $mahasiswaTertinggi; ?>)</p>
    </div>

</body>
</html>