<?php
function hitungNilaiAkhir($tugas, $uts, $uas)
{
    return ($tugas * 0.30) + ($uts * 0.35) + ($uas * 0.35);
}

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

function tentukanStatus($nilaiAkhir)
{
    return $nilaiAkhir >= 60 ? "Lulus" : "Tidak Lulus";
}

$mahasiswa = [
    [
        "nama" => "Naufal Luthfi Assary",
        "nim" => "2311102125",
        "tugas" => 85,
        "uts" => 90,
        "uas" => 95
    ],
    [
        "nama" => "Nenen Shaduq",
        "nim" => "2311102146",
        "tugas" => 70,
        "uts" => 65,
        "uas" => 72
    ],
    [
        "nama" => "Naufal iLutS",
        "nim" => "2311102123",
        "tugas" => 90,
        "uts" => 88,
        "uas" => 92
    ],
    [
        "nama" => "Ricul Amba",
        "nim" => "2311102111",
        "tugas" => 70,
        "uts" => 88,
        "uas" => 80
    ]
];

$totalNilaiAkhir = 0;
$nilaiTertinggi = 0;
$namaNilaiTertinggi = "";

for ($i = 0; $i < count($mahasiswa); $i++) {
    $nilaiAkhir = hitungNilaiAkhir(
        $mahasiswa[$i]["tugas"],
        $mahasiswa[$i]["uts"],
        $mahasiswa[$i]["uas"]
    );

    $grade = tentukanGrade($nilaiAkhir);
    $status = tentukanStatus($nilaiAkhir);

    $mahasiswa[$i]["nilai_akhir"] = $nilaiAkhir;
    $mahasiswa[$i]["grade"] = $grade;
    $mahasiswa[$i]["status"] = $status;

    $totalNilaiAkhir += $nilaiAkhir;

    if ($nilaiAkhir > $nilaiTertinggi) {
        $nilaiTertinggi = $nilaiAkhir;
        $namaNilaiTertinggi = $mahasiswa[$i]["nama"];
    }
}

$rataRataKelas = $totalNilaiAkhir / count($mahasiswa);
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
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #eef2ff, #f8fafc);
            color: #1e293b;
            padding: 40px 20px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .identity {
            text-align: left;
            margin-bottom: 20px;
            background: #ffffff;
            padding: 14px 18px;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            display: inline-block;
        }

        .identity h4 {
            font-size: 16px;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .identity p {
            font-size: 14px;
            color: #475569;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 32px;
            margin-bottom: 8px;
            color: #0f172a;
        }

        .header p {
            color: #475569;
            font-size: 16px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: #ffffff;
            padding: 20px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        }

        .card h3 {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .card p {
            font-size: 28px;
            font-weight: bold;
            color: #0f172a;
        }

        .table-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #2563eb;
            color: white;
        }

        th, td {
            padding: 16px;
            text-align: center;
        }

        tbody tr {
            border-bottom: 1px solid #e2e8f0;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: bold;
        }

        .grade-a { background: #dcfce7; color: #166534; }
        .grade-b { background: #dbeafe; color: #1d4ed8; }
        .grade-c { background: #fef3c7; color: #b45309; }
        .grade-d { background: #fde68a; color: #92400e; }
        .grade-e { background: #fee2e2; color: #b91c1c; }

        .lulus {
            color: #16a34a;
            font-weight: bold;
        }

        .tidak-lulus {
            color: #dc2626;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .table-card {
                overflow-x: auto;
            }

            table {
                min-width: 900px;
            }

            .header h1 {
                font-size: 26px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="identity">
            <h4>Nama: Naufal Luthfi Assary</h4>
            <p>NIM: 2311102125</p>
        </div>

        <div class="header">
            <h1>Sistem Penilaian Mahasiswa</h1>
            <p>Modul 9 PHP - Aplikasi Berbasis Platform</p>
        </div>

        <div class="stats">
            <div class="card">
                <h3>Jumlah Mahasiswa</h3>
                <p><?php echo count($mahasiswa); ?></p>
            </div>
            <div class="card">
                <h3>Rata-rata Kelas</h3>
                <p><?php echo number_format($rataRataKelas, 2); ?></p>
            </div>
            <div class="card">
                <h3>Nilai Tertinggi</h3>
                <p><?php echo number_format($nilaiTertinggi, 2); ?></p>
            </div>
            <div class="card">
                <h3>Mahasiswa Terbaik</h3>
                <p style="font-size: 20px;"><?php echo $namaNilaiTertinggi; ?></p>
            </div>
        </div>

        <div class="table-card">
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
                    <?php
                    $no = 1;
                    foreach ($mahasiswa as $mhs) {
                        $gradeClass = "grade-" . strtolower($mhs["grade"]);
                        $statusClass = $mhs["status"] == "Lulus" ? "lulus" : "tidak-lulus";

                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $mhs["nama"] . "</td>";
                        echo "<td>" . $mhs["nim"] . "</td>";
                        echo "<td>" . $mhs["tugas"] . "</td>";
                        echo "<td>" . $mhs["uts"] . "</td>";
                        echo "<td>" . $mhs["uas"] . "</td>";
                        echo "<td>" . number_format($mhs["nilai_akhir"], 2) . "</td>";
                        echo "<td><span class='badge $gradeClass'>" . $mhs["grade"] . "</span></td>";
                        echo "<td><span class='$statusClass'>" . $mhs["status"] . "</span></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>