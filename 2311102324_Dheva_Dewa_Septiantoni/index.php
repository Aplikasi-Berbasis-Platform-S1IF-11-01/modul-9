<?php
$data_mahasiswa = [
    [
        "nama" => "Budi Santoso",
        "nim" => "1101234",
        "nilai_tugas" => 85,
        "nilai_uts" => 80,
        "nilai_uas" => 90
    ],
    [
        "nama" => "Siti Aminah",
        "nim" => "1101235",
        "nilai_tugas" => 70,
        "nilai_uts" => 65,
        "nilai_uas" => 50
    ],
    [
        "nama" => "Ahmad Fauzi",
        "nim" => "1101236",
        "nilai_tugas" => 90,
        "nilai_uts" => 85,
        "nilai_uas" => 88
    ],
    [
        "nama" => "Rina Kumala",
        "nim" => "1101237",
        "nilai_tugas" => 55,
        "nilai_uts" => 60,
        "nilai_uas" => 60
    ]
];

function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

function tentukanGrade($nilai) {
    if ($nilai >= 85) {
        return "A";
    } elseif ($nilai >= 70) {
        return "B";
    } elseif ($nilai >= 55) {
        return "C";
    } elseif ($nilai >= 40) {
        return "D";
    } else {
        return "E";
    }
}

function tentukanStatus($nilai) {
    if ($nilai >= 60) {
        return "Lulus";
    } else {
        return "Tidak Lulus";
    }
}

$total_nilai_kelas = 0;
$nilai_tertinggi = 0;
$jumlah_mahasiswa = count($data_mahasiswa);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
        .lulus { color: white; background-color: #28a745; font-weight: bold; }
        .gagal { color: white; background-color: #dc3545; font-weight: bold; }
        .ringkasan { background-color: #e9ecef; padding: 15px; border-radius: 5px; width: 300px; }
    </style>
</head>
<body>

    <h2>Data Penilaian Mahasiswa</h2>

    <table>
        <tr>
            <th>Nama</th>
            <th>NIM</th>
            <th>Nilai Akhir</th>
            <th>Grade</th>
            <th>Status</th>
        </tr>

        <?php
        // 5. Loop untuk menampilkan seluruh data
        foreach ($data_mahasiswa as $mhs) {
            $nilai_akhir = hitungNilaiAkhir($mhs['nilai_tugas'], $mhs['nilai_uts'], $mhs['nilai_uas']);
            $grade = tentukanGrade($nilai_akhir);
            $status = tentukanStatus($nilai_akhir);

            // Akumulasi untuk rata-rata dan pencarian nilai tertinggi
            $total_nilai_kelas += $nilai_akhir;
            if ($nilai_akhir > $nilai_tertinggi) {
                $nilai_tertinggi = $nilai_akhir;
            }

            // CSS class untuk warna status kelulusan
            $status_class = ($status == "Lulus") ? "lulus" : "gagal";

            echo "<tr>";
            echo "<td>{$mhs['nama']}</td>";
            echo "<td>{$mhs['nim']}</td>";
            echo "<td>" . number_format($nilai_akhir, 2) . "</td>";
            echo "<td>{$grade}</td>";
            echo "<td class='{$status_class}'>{$status}</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <?php
    // Menghitung rata-rata dari total nilai dibagi jumlah mahasiswa
    $rata_rata_kelas = $total_nilai_kelas / $jumlah_mahasiswa;
    ?>

    <div class="ringkasan">
        <h3>Ringkasan Kelas</h3>
        <p><b>Rata-rata Kelas:</b> <?php echo number_format($rata_rata_kelas, 2); ?></p>
        <p><b>Nilai Tertinggi:</b> <?php echo number_format($nilai_tertinggi, 2); ?></p>
    </div>

</body>
</html>