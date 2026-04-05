<?php
// Fungsi menghitung nilai akhir dengan bobot (Tugas: 30%, UTS: 30%, UAS: 40%)
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

// Fungsi menentukan Grade
function tentukanGrade($nilai) {
    if ($nilai >= 85) return "A";
    if ($nilai >= 75) return "B";
    if ($nilai >= 60) return "C";
    if ($nilai >= 45) return "D";
    return "E";
}

// Fungsi menentukan Status Kelulusan
function cekKelulusan($nilai) {
    return $nilai >= 60 ? "LULUS" : "TIDAK LULUS";
}

// Fungsi mendapatkan warna badge berdasarkan status
function getStatusBadge($status) {
    return $status == "LULUS" ? "badge-lulus" : "badge-tidak-lulus";
}
?>