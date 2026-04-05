<?php
// 1. Data Mahasiswa menggunakan Array Asosiatif
$daftar_mahasiswa = [
    [
        "nama" => "Sherine Naura",
        "nim" => "2311102020",
        "tugas" => 85,
        "uts" => 80,
        "uas" => 90
    ],
    [
        "nama" => "Almira Anindia",
        "nim" => "2311102000",
        "tugas" => 70,
        "uts" => 75,
        "uas" => 65
    ],
    [
        "nama" => "Arap fu ji",
        "nim" => "23111000",
        "tugas" => 95,
        "uts" => 88,
        "uas" => 92
    ]
];

// 2. Function untuk menghitung nilai akhir
// Rumus: (Tugas 30%) + (UTS 30%) + (UAS 40%)
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

// 3. Function untuk menentukan Grade (If/Else)
function tentukanGrade($nilai) {
    if ($nilai >= 85) return "A";
    elseif ($nilai >= 75) return "B";
    elseif ($nilai >= 60) return "C";
    elseif ($nilai >= 50) return "D";
    else return "E";
}

// variabel pembantu untuk statistik
$total_nilai_kelas = 0;
$nilai_tertinggi = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        table { width: 80%; border-collapse: collapse; margin: 20px 0; font-family: sans-serif; }
        th, td { border: 1px solid #999; padding: 10px; text-align: center; }
        th { background-color: #f2f2f2; }
        .lulus { color: green; font-weight: bold; }
        .tidak-lulus { color: red; font-weight: bold; }
    </style>
</head>
<body>

    <h2>Daftar Nilai Mahasiswa</h2>

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
            <?php 
            // 4. Loop untuk menampilkan data
            foreach ($daftar_mahasiswa as $mhs) : 
                $nilai_akhir = hitungNilaiAkhir($mhs['tugas'], $mhs['uts'], $mhs['uas']);
                $grade = tentukanGrade($nilai_akhir);
                
                // Menentukan status menggunakan operator perbandingan
                $status = ($nilai_akhir >= 60) ? "Lulus" : "Tidak Lulus";
                $class_status = ($status == "Lulus") ? "lulus" : "tidak-lulus";

                // Akumulasi statistik
                $total_nilai_kelas += $nilai_akhir;
                if ($nilai_akhir > $nilai_tertinggi) {
                    $nilai_tertinggi = $nilai_akhir;
                }
            ?>
            <tr>
                <td><?= $mhs['nama']; ?></td>
                <td><?= $mhs['nim']; ?></td>
                <td><?= number_format($nilai_akhir, 2); ?></td>
                <td><?= $grade; ?></td>
                <td class="<?= $class_status; ?>"><?= $status; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php 
    // 5. Menghitung Rata-rata
    $rata_rata = $total_nilai_kelas / count($daftar_mahasiswa);
    ?>

    <div style="font-family: sans-serif;">
        <p><strong>Rata-rata Nilai Kelas:</strong> <?= number_format($rata_rata, 2); ?></p>
        <p><strong>Nilai Tertinggi:</strong> <?= number_format($nilai_tertinggi, 2); ?></p>
    </div>

</body>
</html>