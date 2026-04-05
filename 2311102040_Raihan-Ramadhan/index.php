<?php
$mahasiswa = [
    [
        "nama" => "Raihan Ramadhan",
        "nim" => "2311102040",
        "nilai_tugas" => 85,
        "nilai_uts" => 90,
        "nilai_uas" => 88
    ],
    [
        "nama" => "Shafa Adila Santoso",
        "nim" => "2311102040",
        "nilai_tugas" => 70,
        "nilai_uts" => 68,
        "nilai_uas" => 75
    ],
    [
        "nama" => "Suyatno",
        "nim" => "2311003",
        "nilai_tugas" => 90,
        "nilai_uts" => 92,
        "nilai_uas" => 95
    ]
];

function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);
}

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

function tentukanStatus($nilaiAkhir) {
    return ($nilaiAkhir >= 65) ? "Lulus" : "Tidak Lulus";
}

$totalNilai = 0;
$nilaiTertinggi = 0;
$namaNilaiTertinggi = "";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #dbeafe, #eff6ff);
            padding: 30px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .header {
            background: #1d4ed8;
            color: white;
            text-align: center;
            padding: 25px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header h2 {
            font-size: 20px;
            font-weight: normal;
        }

        .content {
            padding: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #d1d5db;
            padding: 12px;
            text-align: center;
        }

        th {
            background: #2563eb;
            color: white;
        }

        tr:nth-child(even) {
            background: #f9fafb;
        }

        tr:hover {
            background: #e0f2fe;
        }

        .info-box {
            margin-top: 25px;
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            flex: 1;
            min-width: 250px;
            background: #f8fafc;
            border-left: 5px solid #2563eb;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.05);
        }

        .card h3 {
            margin-bottom: 10px;
            color: #1e3a8a;
        }

        .footer {
            text-align: center;
            padding: 15px;
            background: #f1f5f9;
            color: #475569;
            font-size: 14px;
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

<div class="container">
    <div class="header">
        <h1>2311102040 - Raihan Ramadhan</h1>
        <h2>Sistem Penilaian Mahasiswa</h2>
        <p>Modul 9 - PHP</p>
    </div>

    <div class="content">
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

            <?php
            $no = 1;
            foreach ($mahasiswa as $mhs) {
                $nilaiAkhir = hitungNilaiAkhir($mhs["nilai_tugas"], $mhs["nilai_uts"], $mhs["nilai_uas"]);
                $grade = tentukanGrade($nilaiAkhir);
                $status = tentukanStatus($nilaiAkhir);

                $totalNilai += $nilaiAkhir;

                if ($nilaiAkhir > $nilaiTertinggi) {
                    $nilaiTertinggi = $nilaiAkhir;
                    $namaNilaiTertinggi = $mhs["nama"];
                }

                $classStatus = ($status == "Lulus") ? "lulus" : "tidak-lulus";

                echo "<tr>";
                echo "<td>$no</td>";
                echo "<td>{$mhs['nama']}</td>";
                echo "<td>{$mhs['nim']}</td>";
                echo "<td>{$mhs['nilai_tugas']}</td>";
                echo "<td>{$mhs['nilai_uts']}</td>";
                echo "<td>{$mhs['nilai_uas']}</td>";
                echo "<td>" . number_format($nilaiAkhir, 2) . "</td>";
                echo "<td>$grade</td>";
                echo "<td class='$classStatus'>$status</td>";
                echo "</tr>";

                $no++;
            }

            $rataRataKelas = $totalNilai / count($mahasiswa);
            ?>
        </table>

        <div class="info-box">
            <div class="card">
                <h3>Rata-rata Kelas</h3>
                <p><?php echo number_format($rataRataKelas, 2); ?></p>
            </div>

            <div class="card">
                <h3>Nilai Tertinggi</h3>
                <p><?php echo number_format($nilaiTertinggi, 2); ?></p>
                <p><strong><?php echo $namaNilaiTertinggi; ?></strong></p>
            </div>
        </div>
    </div>

    <div class="footer">
        &copy; 2311102040 - Raihan Ramadhan | Sistem Penilaian Mahasiswa
    </div>
</div>

</body>
</html>