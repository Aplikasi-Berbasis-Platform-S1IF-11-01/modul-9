<?php
// ============================================================
// 2311102128 - Qonita Rahayu Atmi
// ============================================================

require_once 'data.php'; // Array asosiatif $mahasiswa

// Fungsi untuk menghitung nilai akhir
function hitungNilaiAkhir($tugas, $uts, $uas) {
    $nilai_akhir = ($tugas * 0.30) + ($uts * 0.35) + ($uas * 0.35);
    return round($nilai_akhir, 2);
}

// Fungsi untuk menentukan grade
function tentukanGrade($nilai_akhir) {
    if ($nilai_akhir >= 85) {
        return "A";
    } elseif ($nilai_akhir >= 75) {
        return "B";
    } elseif ($nilai_akhir >= 65) {
        return "C";
    } elseif ($nilai_akhir >= 55) {
        return "D";
    } else {
        return "E";
    }
}

// Fungsi untuk menentukan status lulus/tidak
function tentukanStatus($nilai_akhir) {
    if ($nilai_akhir >= 65) {
        return "LULUS";
    } else {
        return "TIDAK LULUS";
    }
}

// ============================================================
// PROSES DATA & HITUNG STATISTIK
// ============================================================

$total_nilai     = 0;
$nilai_tertinggi = 0;
$nama_tertinggi  = "";

foreach ($mahasiswa as $key => $mhs) {
    $na = hitungNilaiAkhir($mhs["nilai_tugas"], $mhs["nilai_uts"], $mhs["nilai_uas"]);
    $mahasiswa[$key]["nilai_akhir"] = $na;

    $mahasiswa[$key]["grade"] = tentukanGrade($na);

    $mahasiswa[$key]["status"] = tentukanStatus($na);
    $total_nilai += $na;
    if ($na > $nilai_tertinggi) {
        $nilai_tertinggi = $na;
        $nama_tertinggi  = $mhs["nama"];
    }
}

$jumlah_mahasiswa = count($mahasiswa);
$rata_rata        = round($total_nilai / $jumlah_mahasiswa, 2);