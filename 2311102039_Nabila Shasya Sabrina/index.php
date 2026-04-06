<?php
// ==========================
// DATA MAHASISWA
// ==========================
$mahasiswa = [
    [
        "nama" => "Nabila Shasya",
        "nim" => "2311102039",
        "tugas" => 85,
        "uts" => 80,
        "uas" => 90
    ],
    [
        "nama" => "Nathan Hildan",
        "nim" => "2311102037",
        "tugas" => 70,
        "uts" => 75,
        "uas" => 65
    ],
    [
        "nama" => "Mirai Gauri",
        "nim" => "2311102035",
        "tugas" => 95,
        "uts" => 90,
        "uas" => 93
    ]
];

// ==========================
// FUNCTION NILAI AKHIR
// ==========================
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return (0.3 * $tugas) + (0.3 * $uts) + (0.4 * $uas);
}

// ==========================
// FUNCTION GRADE
// ==========================
function getGrade($nilai) {
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

// ==========================
// INISIALISASI
// ==========================
$totalNilai = 0;
$nilaiTertinggi = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        body {
            font-family: Arial;
        }
        h2 {
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #ddd;
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

<?php
// ==========================
// LOOP DATA
// ==========================
foreach ($mahasiswa as $mhs) {

    $nilaiAkhir = hitungNilaiAkhir($mhs['tugas'], $mhs['uts'], $mhs['uas']);
    $grade = getGrade($nilaiAkhir);

    // Status kelulusan
    if ($nilaiAkhir >= 60) {
        $status = "Lulus";
    } else {
        $status = "Tidak Lulus";
    }

    // Hitung total
    $totalNilai += $nilaiAkhir;

    // Cek nilai tertinggi
    if ($nilaiAkhir > $nilaiTertinggi) {
        $nilaiTertinggi = $nilaiAkhir;
    }

    echo "<tr>
            <td>{$mhs['nama']}</td>
            <td>{$mhs['nim']}</td>
            <td>" . number_format($nilaiAkhir, 2) . "</td>
            <td>$grade</td>
            <td>$status</td>
          </tr>";
}

// ==========================
// HITUNG RATA-RATA
// ==========================
$rataRata = $totalNilai / count($mahasiswa);
?>

</table>

<h3 style="text-align:center;">
    Rata-rata Kelas: <?php echo number_format($rataRata, 2); ?>
</h3>

<h3 style="text-align:center;">
    Nilai Tertinggi: <?php echo number_format($nilaiTertinggi, 2); ?>
</h3>

</body>
</html>