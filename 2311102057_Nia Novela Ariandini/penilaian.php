<?php
$mahasiswa = [
    [
        "nama" => "Nia",
        "nim" => "2311102001",
        "tugas" => 80,
        "uts" => 90,
        "uas" => 85
    ],
    [
        "nama" => "Novela",
        "nim" => "2311102002",
        "tugas" => 70,
        "uts" => 80,
        "uas" => 80
    ],
    [
        "nama" => "Ariandini",
        "nim" => "2311102003",
        "tugas" => 90,
        "uts" => 85,
        "uas" => 95
    ],
    [
        "nama" => "Dinda",
        "nim" => "2311102004",
        "tugas" => 60,
        "uts" => 50,
        "uas" => 30
    ],
    [
        "nama" => "Salsa",
        "nim" => "2311102005",
        "tugas" => 60,
        "uts" => 50,
        "uas" => 40
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

$totalNilai = 0;
$nilaiTertinggi = 0;
$namaTertinggi = "";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            margin: 0;
            padding: 30px;
            background: linear-gradient(135deg, #fff8fc, #ffeef5);
            color: #5c4252;
        }

        .container {
            max-width: 1150px;
            margin: 0 auto;
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid #f7d8e5;
            border-radius: 26px;
            box-shadow: 0 14px 35px rgba(223, 148, 176, 0.14);
            overflow: hidden;
        }

        .header {
            padding: 34px 38px;
            background: linear-gradient(135deg, #ffdbe8, #ffcfe0, #ffdfea);
            border-bottom: 1px solid #f5c8d8;
        }

        .header h1 {
            margin: 0 0 10px;
            font-size: 34px;
            font-weight: 700;
            color: #b04d77;
            letter-spacing: 0.3px;
            text-shadow: 0 3px 10px rgba(176, 77, 119, 0.10);
        }

        .header p {
            margin: 0;
            font-size: 16px;
            color: #9f6280;
            line-height: 1.6;
        }

        .table-wrap {
            padding: 25px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 18px;
            overflow: hidden;
        }

        th {
            background: #fde7f0;
            color: #b04d77;
            padding: 15px;
            font-size: 15px;
            text-align: center;
            border-bottom: 2px solid #f6cadb;
        }

        td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #f8d8e4;
            background: #fffafd;
            color: #6b5360;
        }

        tr:hover td {
            background: #fff3f8;
            transition: 0.3s ease;
        }

        .badge {
            display: inline-block;
            min-width: 42px;
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
        }

        .grade-a { background: #ffd8e8; color: #b03060; }
        .grade-b { background: #ffe7f1; color: #c2517f; }
        .grade-c { background: #fff0f6; color: #c96b91; }
        .grade-d { background: #ffe8ee; color: #d06c88; }
        .grade-e { background: #fde2e4; color: #b64b61; }

        .lulus {
            color: #2e8b57;
            font-weight: 700;
        }

        .tidak-lulus {
            color: #c94f6d;
            font-weight: 700;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 18px;
            padding: 0 25px 25px;
        }

        .summary-box {
            background: linear-gradient(180deg, #fff9fc, #fff3f8);
            border: 1px solid #f4d2df;
            border-radius: 20px;
            padding: 22px;
            box-shadow: 0 8px 20px rgba(221, 144, 171, 0.08);
        }

        .summary-box h3 {
            margin: 0 0 12px;
            font-size: 15px;
            color: #b55b80;
        }

        .summary-box p {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: #7b4b63;
        }

        .summary-box .nama-tertinggi {
            font-size: 18px;
        }

        @media (max-width: 768px) {
            body {
                padding: 16px;
            }

            .header {
                padding: 24px;
            }

            .header h1 {
                font-size: 26px;
            }

            .header p {
                font-size: 14px;
            }

            th, td {
                padding: 11px;
                font-size: 14px;
            }

            .summary-box p {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>🌸 Sistem Penilaian Mahasiswa</h1>
                <p>Menampilkan data mahasiswa, nilai akhir, grade, status kelulusan, rata-rata kelas, dan nilai tertinggi.</p>
            </div>

            <div class="table-wrap">
                <table>
                    <tr>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Nilai Tugas</th>
                        <th>Nilai UTS</th>
                        <th>Nilai UAS</th>
                        <th>Nilai Akhir</th>
                        <th>Grade</th>
                        <th>Status</th>
                    </tr>

                    <?php foreach ($mahasiswa as $mhs): ?>
                        <?php
                            $nilaiAkhir = hitungNilaiAkhir($mhs['tugas'], $mhs['uts'], $mhs['uas']);
                            $grade = tentukanGrade($nilaiAkhir);
                            $status = ($nilaiAkhir >= 60) ? "Lulus" : "Tidak Lulus";

                            $totalNilai += $nilaiAkhir;

                            if ($nilaiAkhir > $nilaiTertinggi) {
                                $nilaiTertinggi = $nilaiAkhir;
                                $namaTertinggi = $mhs['nama'];
                            }

                            $gradeClass = "grade-" . strtolower($grade);
                        ?>
                        <tr>
                            <td><?= $mhs['nama']; ?></td>
                            <td><?= $mhs['nim']; ?></td>
                            <td><?= $mhs['tugas']; ?></td>
                            <td><?= $mhs['uts']; ?></td>
                            <td><?= $mhs['uas']; ?></td>
                            <td><?= number_format($nilaiAkhir, 2); ?></td>
                            <td><span class="badge <?= $gradeClass; ?>"><?= $grade; ?></span></td>
                            <td class="<?= ($status == 'Lulus') ? 'lulus' : 'tidak-lulus'; ?>">
                                <?= $status; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <?php $rataRata = $totalNilai / count($mahasiswa); ?>

            <div class="summary">
                <div class="summary-box">
                    <h3>Rata-rata Kelas</h3>
                    <p><?= number_format($rataRata, 2); ?></p>
                </div>
                <div class="summary-box">
                    <h3>Nilai Tertinggi</h3>
                    <p><?= number_format($nilaiTertinggi, 2); ?></p>
                </div>
                <div class="summary-box">
                    <h3>Mahasiswa Nilai Tertinggi</h3>
                    <p class="nama-tertinggi"><?= $namaTertinggi; ?></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>