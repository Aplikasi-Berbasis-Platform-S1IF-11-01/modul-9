<div align="center">

# LAPORAN PRAKTIKUM
# APLIKASI BERBASIS PLATFORM

---

## MODUL 9
## PHP

---

<img src="Logo_Telkom.png" width="200">

---

**Disusun Oleh :**

**RELI GITA NURHIDAYATI**

**2311102025**

**S1 IF-11-REG01**

---

**Dosen Pengampu :**

Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom

---

**Asisten Praktikum :**

Apri Pandu Wicaksono

Rangga Pradarrell Fathi

---

**LABORATORIUM HIGH PERFORMANCE**

**FAKULTAS INFORMATIKA**

**UNIVERSITAS TELKOM PURWOKERTO**

**2026**

</div>

---

## 1. Dasar Teori

**PHP** adalah bahasa server side scripting yaitu teknologi pemrograman dimana script atau programnya dikompilasi dan diterjemahkan di sisi server. Fungsi utamanya untuk menerima permintaan dari browser dan mengirimkan kembali hasilnya dalam bentuk halaman web (HTML). Berikut merupakan variabel yang digunakan untuk menyimpan nilai, data, atau informasi:
- Simbol: Nama variabel selalu diawali dengan tanda `$`.
- Aturan Nama: Harus diawali huruf atau underscore (_), tidak boleh mengandung spasi, dan bersifat case sensitive.
- Tipe Data: PHP mendukung 8 tipe data primitif, di antaranya: Boolean, Integer, Float, String, Array, Object, Resource, dan NULL.

---

## 2. Source Code
```php
<?php
// DATA MAHASISWA
$mahasiswa = [
    ["nama" => "Reli Gita Nurhidayati", "nim" => "2311102025", "nilai_tugas" => 88, "nilai_uts" => 90, "nilai_uas" => 92],
    ["nama" => "Budi Setiawan",         "nim" => "2311102026", "nilai_tugas" => 75, "nilai_uts" => 70, "nilai_uas" => 68],
    ["nama" => "Siti Aminah",           "nim" => "2311102027", "nilai_tugas" => 60, "nilai_uts" => 55, "nilai_uas" => 58],
];

function hitungNilaiAkhir($tugas, $uts, $uas) {
    return round(($tugas * 0.30) + ($uts * 0.35) + ($uas * 0.35), 2);
}

function tentukanGrade($nilai) {
    if ($nilai >= 85) return "A";
    elseif ($nilai >= 75) return "B";
    elseif ($nilai >= 65) return "C";
    elseif ($nilai >= 50) return "D";
    else return "E";
}

function tentukanStatus($nilai) {
    return ($nilai >= 65) ? "LULUS" : "TIDAK LULUS";
}
?>
```

---

## 3. Penjelasan Kode

Program menyimpan data mahasiswa ke dalam **Array Asosiatif** `$mahasiswa`, dimana setiap elemen memiliki kunci spesifik seperti nama, NIM, dan komponen nilai (Tugas, UTS, UAS). Pengolahan data dilakukan menggunakan tiga fungsi utama:

- `hitungNilaiAkhir()` — menghitung nilai akhir dengan rumus: **(Tugas × 30%) + (UTS × 35%) + (UAS × 35%)**
- `tentukanGrade()` — mengklasifikasikan nilai angka ke indeks huruf dengan threshold: A (≥85), B (≥75), C (≥65), D (≥50), E (<50)
- `tentukanStatus()` — menentukan status kelulusan, **LULUS** jika nilai akhir ≥ 65

Proses penyajian data menggunakan perulangan `foreach` yang memproses setiap data mahasiswa dan menampilkannya dalam Tabel HTML beserta statistik kelas.

---

## 4. Hasil

<div align="center">
  <img src="Screenshoot hasil tugas 9.png" width="700">
</div>
