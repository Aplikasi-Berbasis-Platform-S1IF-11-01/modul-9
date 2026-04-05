<?php
// Andreas Besar Wibowo
// 2311102198 / IF-11-01

// Data Mahasiswa
$mahasiswa = [
    [
        "nama" => "Andreas Besar Wibowo",
        "nim" => "001",
        "tugas" => 90,
        "uts" => 88,
        "uas" => 85
    ],
    [
        "nama" => "Joko Susilo",
        "nim" => "002",
        "tugas" => 70,
        "uts" => 65,
        "uas" => 60
    ],
    [
        "nama" => "Indra Budiman",
        "nim" => "003",
        "tugas" => 90,
        "uts" => 70,
        "uas" => 92
    ],
    [
        "nama" => "Citra Sudirman",
        "nim" => "004",
        "tugas" => 50,
        "uts" => 40,
        "uas" => 30
    ]
];

// Fungsi hitung nilai akhir
function hitungNilaiAkhir($tugas, $uts, $uas)
{
    return (0.3 * $tugas) + (0.3 * $uts) + (0.4 * $uas);
}

// Fungsi menentukan grade
function tentukanGrade($nilai)
{
    if ($nilai > 85)
        return "A";
    elseif ($nilai > 75)
        return "AB";
    elseif ($nilai > 65)
        return "B";
    elseif ($nilai > 60)
        return "BC";
    elseif ($nilai > 50)
        return "C";
    elseif ($nilai > 40)
        return "D";
    else
        return "E";
}

// Variabel tambahan
$totalNilai = 0;
$nilaiTertinggi = 0;
?>

<!-- File HTML -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Sistem Penilaian Mahasiswa (PHP) </title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- Styling -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            border-radius: 8px;
            overflow: hidden;
        }

        th {
            background-color: #343a40;
            color: white;
            padding: 12px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .lulus {
            color: #28a745;
            font-weight: bold;
        }

        .tidak {
            color: #dc3545;
            font-weight: bold;
        }

        .summary {
            margin-top: 25px;
            text-align: center;
        }

        .card {
            display: inline-block;
            margin: 10px;
            padding: 15px 25px;
            border-radius: 8px;
            background: #f8f9fa;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .card strong {
            color: #555;
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>Data Nilai Mahasiswa</h2>

        <table>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Nilai Akhir</th>
                <th>Grade</th>
                <th>Status</th>
            </tr>

            <?php foreach ($mahasiswa as $mhs): ?>
                <?php
                $nilaiAkhir = hitungNilaiAkhir($mhs["tugas"], $mhs["uts"], $mhs["uas"]);
                $grade = tentukanGrade($nilaiAkhir);
                $status = ($grade == "D" || $grade == "E") ? "Tidak Lulus" : "Lulus";

                $totalNilai += $nilaiAkhir;
                if ($nilaiAkhir > $nilaiTertinggi) {
                    $nilaiTertinggi = $nilaiAkhir;
                }
                ?>
                <tr>
                    <td><?= $mhs["nama"]; ?></td>
                    <td><?= $mhs["nim"]; ?></td>
                    <td><?= number_format($nilaiAkhir, 2); ?></td>
                    <td><?= $grade; ?></td>
                    <td class="<?= ($status == 'Lulus') ? 'lulus' : 'tidak'; ?>">
                        <?= $status; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <?php $rataRata = $totalNilai / count($mahasiswa); ?>

        <div class="summary">
            <div class="card">
                <strong>Rata-rata</strong><br>
                <?= number_format($rataRata, 2); ?>
            </div>

            <div class="card">
                <strong>Nilai Tertinggi</strong><br>
                <?= number_format($nilaiTertinggi, 2); ?>
            </div>
        </div>

    </div>

</body>

</html>