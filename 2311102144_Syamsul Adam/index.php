<?php
// 1. Data Mahasiswa menggunakan Array Asosiatif
$daftar_mahasiswa = [
    [
        "nama" => "Syamsul Adam",
        "nim"  => "2311102144",
        "tugas" => 98,
        "uts"   => 90,
        "uas"   => 92,5
    ],
    [
        "nama" => "Faleno",
        "nim"  => "2311102194",
        "tugas" => 80,
        "uts"   => 95,
        "uas"   => 85
    ],
    [
        "nama" => "Iin",
        "nim"  => "2311100001",
        "tugas" => 60,
        "uts"   => 55,
        "uas"   => 50
    ],
    [
        "nama" => "Adi Saputra",
        "nim"  => "2311100002",
        "tugas" => 85,
        "uts"   => 80,
        "uas"   => 88
    ],
    [
        "nama" => "Siti Nurhaliza",
        "nim"  => "2311100003",
        "tugas" => 90,
        "uts"   => 85,
        "uas"   => 92
    ],
    [
        "nama" => "Budi Raharjo",
        "nim"  => "2311100004",
        "tugas" => 75,
        "uts"   => 70,
        "uas"   => 65
    ],
    [
        "nama" => "Dewi Lestari",
        "nim"  => "2311100005",
        "tugas" => 80,
        "uts"   => 78,
        "uas"   => 82
    ],
    [
        "nama" => "Fajar Nugraha",
        "nim"  => "2311100006",
        "tugas" => 55,
        "uts"   => 60,
        "uas"   => 58
    ],
    [
        "nama" => "Gita Permata",
        "nim"  => "2311100007",
        "tugas" => 88,
        "uts"   => 90,
        "uas"   => 85
    ],
    [
        "nama" => "Hendra Wijaya",
        "nim"  => "2311100008",
        "tugas" => 70,
        "uts"   => 65,
        "uas"   => 72
    ],
    [
        "nama" => "Indah Kusuma",
        "nim"  => "2311100009",
        "tugas" => 95,
        "uts"   => 92,
        "uas"   => 94
    ],
    [
        "nama" => "Joko Susilo",
        "nim"  => "2311100010",
        "tugas" => 45,
        "uts"   => 50,
        "uas"   => 48
    ]
];

// 2. Function untuk menghitung nilai akhir
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

// 3. Function untuk menentukan Grade
function tentukanGrade($nilai) {
    if ($nilai >= 85) return "A";
    elseif ($nilai >= 75) return "B";
    elseif ($nilai >= 60) return "C";
    elseif ($nilai >= 50) return "D";
    else return "E";
}

// Inisialisasi variabel untuk statistik
$total_nilai_kelas = 0;
$nilai_tertinggi = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid 
        th { background-color:
        .lulus { color: green; font-weight: bold; }
        .tidak-lulus { color: red; font-weight: bold; }
        .statistik { margin-top: 20px; padding: 15px; background:
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
                
                // 5. Operator Perbandingan untuk status kelulusan
                $status = ($nilai_akhir >= 60) ? "Lulus" : "Tidak Lulus";
                $class_status = ($status == "Lulus") ? "lulus" : "tidak-lulus";

                // Update statistik
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

    <div class="statistik">
        <?php 
            $rata_rata = $total_nilai_kelas / count($daftar_mahasiswa);
        ?>
        <p><strong>Rata-rata Kelas:</strong> <?= number_format($rata_rata, 2); ?></p>
        <p><strong>Nilai Tertinggi:</strong> <?= number_format($nilai_tertinggi, 2); ?></p>
    </div>

</body>
</html>