<?php
// Function menggunakan operator aritmatika untuk menghitung nilai akhir
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.2) + ($uts * 0.3) + ($uas * 0.5);
}

// Function menggunakan if/else untuk menentukan Grade
function tentukanGrade($nilai_akhir) {
    if ($nilai_akhir >= 85) {
        return 'A';
    } elseif ($nilai_akhir >= 75) {
        return 'B';
    } elseif ($nilai_akhir >= 65) {
        return 'C';
    } elseif ($nilai_akhir >= 50) {
        return 'D';
    } else {
        return 'E';
    }
}

// Function menggunakan operator perbandingan untuk status kelulusan
function tentukanStatus($nilai_akhir) {
    if ($nilai_akhir >= 65) {
        return 'Lulus';
    } else {
        return 'Tidak Lulus';
    }
}

// Data mahasiswa dalam bentuk Array Asosiatif
$data_mahasiswa = [
    [
        "nama" => "Aisyah Anis Mazaya",
        "nim" => "20230001",
        "nilai_tugas" => 85,
        "nilai_uts" => 90,
        "nilai_uas" => 90
    ],
    [
        "nama" => "Bagas Putra D",
        "nim" => "20230002",
        "nilai_tugas" => 60,
        "nilai_uts" => 55,
        "nilai_uas" => 65
    ],
    [
        "nama" => "Rina Melati Sekar",
        "nim" => "20230003",
        "nilai_tugas" => 90,
        "nilai_uts" => 85,
        "nilai_uas" => 88
    ],
    [
        "nama" => "Gilang Ramadhani",
        "nim" => "20230004",
        "nilai_tugas" => 87,
        "nilai_uts" => 50,
        "nilai_uas" => 45
    ]
];

$total_semua_nilai = 0;
$nilai_tertinggi = 0;
$jumlah_mahasiswa = count($data_mahasiswa);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            /* Menggunakan font Poppins */
            font-family: 'Poppins', sans-serif;
            background-color: #fff0f5; 
            color: #4a4a4a;
            margin: 0;
            padding: 40px 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(255, 182, 193, 0.4);
        }
        h2 {
            text-align: center;
            color: #d16b8e; 
            margin-bottom: 25px;
            font-weight: 600;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        th, td {
            padding: 14px 15px;
            text-align: left;
            border-bottom: 1px solid #ffc0cb; 
        }
        th {
            background-color: #ffb6c1; 
            color: #ffffff;
            font-weight: 600;
        }
        tr:hover {
            background-color: #ffe4e1; 
        }
        .badge-lulus {
            background-color: #a8e6cf;
            color: #2b7a5a;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 0.85em;
            font-weight: 600;
        }
        .badge-gagal {
            background-color: #ffcccb;
            color: #cc0000;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 0.85em;
            font-weight: 600;
        }
        .summary-box {
            background-color: #fff5f7;
            border: 1px dashed #d16b8e;
            padding: 15px 20px;
            border-radius: 8px;
            color: #d16b8e;
        }
        .summary-box p {
            margin: 8px 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px; /* Jarak antara icon dan teks */
        }
        .summary-box i {
            font-size: 1.2em;
        }
    </style>
</head>
<body>

<div class="container">
    <h2><i class="fa-solid fa-graduation-cap" style="margin-right: 10px;"></i>Rekap Nilai Mahasiswa</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Nilai Akhir</th>
                <th>Grade</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            // loop untuk menampilkan data
            foreach ($data_mahasiswa as $mhs) {
                $nilai_akhir = hitungNilaiAkhir($mhs['nilai_tugas'], $mhs['nilai_uts'], $mhs['nilai_uas']);
                $grade = tentukanGrade($nilai_akhir);
                $status = tentukanStatus($nilai_akhir);

                $total_semua_nilai += $nilai_akhir;

                if ($nilai_akhir > $nilai_tertinggi) {
                    $nilai_tertinggi = $nilai_akhir;
                }

                $status_class = ($status == 'Lulus') ? 'badge-lulus' : 'badge-gagal';

                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $mhs['nama'] . "</td>";
                echo "<td>" . $mhs['nim'] . "</td>";
                echo "<td>" . number_format($nilai_akhir, 2) . "</td>"; 
                echo "<td>" . $grade . "</td>";
                echo "<td><span class='$status_class'>" . $status . "</span></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    $rata_rata_kelas = $total_semua_nilai / $jumlah_mahasiswa;
    ?>

    <div class="summary-box">
        <p><i class="fa-solid fa-chart-line"></i> Rata-rata Kelas : <?php echo number_format($rata_rata_kelas, 2); ?></p>
        <p><i class="fa-solid fa-trophy"></i> Nilai Tertinggi : <?php echo number_format($nilai_tertinggi, 2); ?></p>
    </div>
</div>

</body>
</html>