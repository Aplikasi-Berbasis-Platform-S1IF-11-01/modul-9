<?php
// Function untuk menghitung nilai akhir dengan bobot (Tugas 30%, UTS 30%, UAS 40%)
function hitungNilaiAkhir($tugas, $uts, $uas) {
    // Menggunakan operator aritmatika
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

// Function menggunakan if/else atau switch untuk menentukan grade
function tentukanGrade($nilai_akhir) {
    if ($nilai_akhir >= 85) {
        return "A";
    } elseif ($nilai_akhir >= 75) {
        return "B";
    } elseif ($nilai_akhir >= 65) {
        return "C";
    } elseif ($nilai_akhir >= 50) {
        return "D";
    } else {
        return "E";
    }
}

// Function menggunakan operator perbandingan untuk menentukan status lulus/tidak
function tentukanStatus($nilai_akhir) {
    // Nilai Minimal Lulus adalah 65 (Grade C)
    return $nilai_akhir >= 65 ? "Lulus" : "Tidak Lulus";
}
?>
