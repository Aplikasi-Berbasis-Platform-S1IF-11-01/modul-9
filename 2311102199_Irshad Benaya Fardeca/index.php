<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas 9</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: sans-serif;
            background: #c4c4c2;
            color: #1a1a1a;
            padding: 2rem 1.5rem;
        }

        h1 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.25rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e5e5e2;
        }

        th {
            padding: 10px 14px;
            text-align: left;
            font-weight: 500;
            font-size: 0.8rem;
            color: #888;
            border-bottom: 1px solid #e5e5e2;
        }

        td {
            padding: 12px 14px;
            border-bottom: 1px solid #f0f0ee;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 500;
        }

        .lulus {
            background: #eaf3de;
            color: #3b6d11;
        }

        .tidak {
            background: #fcebeb;
            color: #a32d2d;
        }

        .summary {
            display: flex;
            gap: 12px;
            margin-top: 1.25rem;
        }

        .card {
            flex: 1;
            background: #fff;
            border: 1px solid #e5e5e2;
            border-radius: 10px;
            padding: 14px 16px;
        }

        .card-label {
            font-size: 0.78rem;
            color: #888;
            margin-bottom: 4px;
        }

        .card-value {
            font-size: 1.5rem;
            font-weight: 600;
        }
    </style>

</head>

<body>
    <?php

    $dataMahasiswa = [
        [
            "nama" => "Irshad",
            "nim" => "231",
            "nilaiTugas" => "90",
            "nilaiUts" => "87",
            "nilaiUas" => "94"
        ],
        [
            "nama" => "Benaya",
            "nim" => "102",
            "nilaiTugas" => "65",
            "nilaiUts" => "45",
            "nilaiUas" => "87"
        ],
        [
            "nama" => "Fardeca",
            "nim" => "199",
            "nilaiTugas" => "40",
            "nilaiUts" => "33",
            "nilaiUas" => "25"
        ],
    ];

    function nilaiAkhir($tugas, $uts, $uas)
    {
        return $tugas * 0.2 + $uts * 0.3 + $uas * 0.5;
    }

    function apaLulus($nilai)
    {
        return ($nilai > 50) ? "Lulus" : "Tidak Lulus";
    }


    function tentukanGrade($nilai)
    {
        switch ($nilai) {
            case ($nilai > 50 && $nilai <= 60):
                return "C";
                break;
            case ($nilai > 60 && $nilai <= 70):
                return "BC";
                break;
            case ($nilai > 70 && $nilai <= 75):
                return "B";
                break;
            case ($nilai > 75 && $nilai <= 80):
                return "AB";
                break;
            case ($nilai > 80 && $nilai <= 100):
                return "A";
                break;
            default:
                return "D";
                break;
        }
    }

    $totalNilai = 0;
    $nilaiTertinggi = 0;
    $jumlahData = count($dataMahasiswa);

    ?>

    <h1>Data Mahasiswa</h1>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Nilai Akhir</th>
                <th>Grade</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataMahasiswa as $mhs):
                $nilaiAkhir = nilaiAkhir($mhs["nilaiTugas"], $mhs["nilaiUts"], $mhs["nilaiUas"]);
                $grade = tentukanGrade($nilaiAkhir);
                $status = apaLulus($nilaiAkhir);
                $totalNilai += $nilaiAkhir;
                if ($nilaiAkhir > $nilaiTertinggi) $nilaiTertinggi = $nilaiAkhir;
                $badgeClass = ($status === "Lulus") ? "lulus" : "tidak";
            ?>
                <tr>
                    <td><?= $mhs["nama"] ?></td>
                    <td style="color:#888"><?= $mhs["nim"] ?></td>
                    <td><?= number_format($nilaiAkhir, 1) ?></td>
                    <td><strong><?= $grade ?></strong></td>
                    <td><span class="badge <?= $badgeClass ?>"><?= $status ?></span></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php
    $rataRata = $totalNilai / $jumlahData;
    ?>

    <div class="summary">
        <div class="card">
            <div class="card-label">Rata-rata Kelas</div>
            <div class="card-value"><?= number_format($rataRata, 2) ?></div>
        </div>
        <div class="card">
            <div class="card-label">Nilai Tertinggi</div>
            <div class="card-value"><?= number_format($nilaiTertinggi, 1) ?></div>
        </div>
    </div>

</body>

</html>