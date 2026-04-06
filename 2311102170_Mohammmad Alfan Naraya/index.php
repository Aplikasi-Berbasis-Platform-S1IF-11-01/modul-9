<?php

$daftarMahasiswa = [
    [
        "nama" => "Mohammad Alfan Naraya",
        "nim" => "2311102170",
        "tugas" => 90,
        "uts" => 85,
        "uas" => 90
    ],
    [
        "nama" => "Shiva Indah Kurnia",
        "nim" => "2311102035",
        "tugas" => 85,
        "uts" => 90,
        "uas" => 85
    ],
    [
        "nama" => "Ibnu Natan",
        "nim" => "2311192910",
        "tugas" => 60,
        "uts" => 65,
        "uas" => 55
    ],
    [
        "nama" => "M Raflan Kemal",
        "nim" => "2311103132",
        "tugas" => 95,
        "uts" => 88,
        "uas" => 92
    ]
];


function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}


function tentukanGrade($nilai) {
    if ($nilai >= 80) return "A";
    elseif ($nilai >= 70) return "B";
    elseif ($nilai >= 60) return "C";
    elseif ($nilai >= 50) return "D";
    else return "E";
}


function tentukanStatus($nilai) {
    return ($nilai >= 60) ? "Lulus" : "Tidak Lulus";
}


$totalNilai = 0;
$nilaiTertinggi = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Penilaian Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Daftar Nilai Mahasiswa</h2>
    
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="table-primary">
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
                   
                    foreach ($daftarMahasiswa as $mhs) : 
                        $nilaiAkhir = hitungNilaiAkhir($mhs['tugas'], $mhs['uts'], $mhs['uas']);
                        $grade = tentukanGrade($nilaiAkhir);
                        $status = tentukanStatus($nilaiAkhir);
                        
                       
                        $totalNilai += $nilaiAkhir;
                        if ($nilaiAkhir > $nilaiTertinggi) {
                            $nilaiTertinggi = $nilaiAkhir;
                        }

                        
                        $statusClass = ($status == "Lulus") ? "text-success fw-bold" : "text-danger fw-bold";
                    ?>
                    <tr>
                        <td><?= $mhs['nama']; ?></td>
                        <td><?= $mhs['nim']; ?></td>
                        <td><?= number_format($nilaiAkhir, 2); ?></td>
                        <td><strong><?= $grade; ?></strong></td>
                        <td class="<?= $statusClass; ?>"><?= $status; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="mt-4 p-3 border rounded bg-white">
                <?php 
                    $rataRata = $totalNilai / count($daftarMahasiswa);
                ?>
                <p><strong>Rata-rata Kelas:</strong> <?= number_format($rataRata, 2); ?></p>
                <p><strong>Nilai Tertinggi:</strong> <?= number_format($nilaiTertinggi, 2); ?></p>
            </div>
        </div>
    </div>
</div>

</body>
</html>