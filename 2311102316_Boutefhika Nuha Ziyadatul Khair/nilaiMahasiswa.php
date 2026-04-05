<?php
// Data Mahasiswa (Array Asosiatif)
$mahasiswa = [
    [
        "nama" => "Boutefhika Nuha Z. K",
        "nim" => "2311102316",
        "tugas" => 80,
        "uts" => 75,
        "uas" => 85
    ],
    [
        "nama" => "Andika Nevtro",
        "nim" => "2311102167",
        "tugas" => 70,
        "uts" => 65,
        "uas" => 60
    ],
    [
        "nama" => "Bintang Sagara",
        "nim" => "2311102214",
        "tugas" => 90,
        "uts" => 85,
        "uas" => 88
    ],
    [
        "nama" => "Dinda Olivia",
        "nim" => "2311102116",
        "tugas" => 85,
        "uts" => 65,
        "uas" => 70
    ],
    [
        "nama" => "Budianto",
        "nim" => "2311102012",
        "tugas" => 50,
        "uts" => 30,
        "uas" => 55
    ]
];

// Function hitung nilai akhir
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

// Function menentukan grade
function tentukanGrade($nilai) {
    if ($nilai >= 85) return "A";
    elseif ($nilai >= 75) return "B";
    elseif ($nilai >= 65) return "C";
    elseif ($nilai >= 50) return "D";
    else return "E";
}

// Variabel tambahan
$totalNilai = 0;
$nilaiTertinggi = 0;

// Tampilan HTML
echo "<h2>Sistem Penilaian Mahasiswa</h2>";
echo "<table border='1' cellpadding='10'>
<tr>
    <th>Nama</th>
    <th>NIM</th>
    <th>Nilai Akhir</th>
    <th>Grade</th>
    <th>Status</th>
</tr>";

// Loop data mahasiswa
foreach ($mahasiswa as $mhs) {
    $nilaiAkhir = hitungNilaiAkhir($mhs['tugas'], $mhs['uts'], $mhs['uas']);
    $grade = tentukanGrade($nilaiAkhir);

    // Status kelulusan
    if ($nilaiAkhir >= 60) {
        $status = "Lulus";
    } else {
        $status = "Tidak Lulus";
    }

    // Hitung total & nilai tertinggi
    $totalNilai += $nilaiAkhir;
    if ($nilaiAkhir > $nilaiTertinggi) {
        $nilaiTertinggi = $nilaiAkhir;
    }

    // Tampilkan data
    echo "<tr>
        <td>{$mhs['nama']}</td>
        <td>{$mhs['nim']}</td>
        <td>" . number_format($nilaiAkhir,2) . "</td>
        <td>$grade</td>
        <td>$status</td>
    </tr>";
}

echo "</table>";

// Rata-rata kelas
$rataRata = $totalNilai / count($mahasiswa);

echo "<br><b>Rata-rata kelas:</b> " . number_format($rataRata,2);
echo "<br><b>Nilai tertinggi:</b> " . number_format($nilaiTertinggi,2);
?>