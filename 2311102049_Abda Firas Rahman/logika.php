<?php
// Array Asosiatif Data Mahasiswa nya
$data_mahasiswa = [
    [
        "nama" => "Abda Firas Rahman",
        "nim" => "2311102049",
        "nilai_tugas" => 85,
        "nilai_uts" => 82,
        "nilai_uas" => 90
    ],
    [
        "nama" => "Bayu Prakoso W",
        "nim" => "2010400212",
        "nilai_tugas" => 59,
        "nilai_uts" => 60,
        "nilai_uas" => 50
    ],
    [
        "nama" => "Citra Adi Lancar",
        "nim" => "2010400312",
        "nilai_tugas" => 90,
        "nilai_uts" => 85,
        "nilai_uas" => 88
    ],
];
// Abda Firas Rahman - 2311102049 - IF-REG-01
// Function menghitung nilai akhir
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

// Menentukan grade atau nilai
function tentukanGrade($nilai) {
    if ($nilai >= 80) return "A";
    if ($nilai >= 70) return "B";
    if ($nilai >= 60) return "C";
    if ($nilai >= 50) return "D";
    return "E";
}

// Persiapan variabel untuk perhitungan kelas
$total_nilai_kelas = 0;
$nilai_tertinggi = 0;
$jumlah_mhs = count($data_mahasiswa);
$hasil_penilaian = [];

// Proses pengolahan data sebelum dikirim ke View
foreach ($data_mahasiswa as $mhs) {
    $nilai_akhir = hitungNilaiAkhir($mhs['nilai_tugas'], $mhs['nilai_uts'], $mhs['nilai_uas']);
    $grade = tentukanGrade($nilai_akhir);
    $status = ($nilai_akhir >= 60) ? "Lulus" : "Tidak Lulus";
    
    $total_nilai_kelas += $nilai_akhir;
    if ($nilai_akhir > $nilai_tertinggi) {
        $nilai_tertinggi = $nilai_akhir;
    }

    // Memasukkan hasil kalkulasi ke dalam array baru
    $mhs['nilai_akhir'] = $nilai_akhir;
    $mhs['grade'] = $grade;
    $mhs['status'] = $status;
    $mhs['class_css'] = ($status == "Lulus") ? "status-lulus" : "status-gagal";
    
    $hasil_penilaian[] = $mhs;
}

$rata_rata_kelas = $total_nilai_kelas / $jumlah_mhs;
?>