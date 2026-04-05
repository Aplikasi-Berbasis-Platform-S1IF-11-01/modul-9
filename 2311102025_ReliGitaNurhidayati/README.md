<div align="center">



\# LAPORAN PRAKTIKUM

\# APLIKASI BERBASIS PLATFORM



\---



\## MODUL 9

\## PHP



\---



<img src="Logo\_Telkom.png" width="200">



\---



\*\*Disusun Oleh :\*\*



\*\*RELI GITA NURHIDAYATI\*\*



\*\*2311102025\*\*



\*\*S1 IF-11-REG01\*\*



\---



\*\*Dosen Pengampu :\*\*



Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom



\---



\*\*Asisten Praktikum :\*\*



Apri Pandu Wicaksono



Rangga Pradarrell Fathi



\---



\*\*LABORATORIUM HIGH PERFORMANCE\*\*



\*\*FAKULTAS INFORMATIKA\*\*



\*\*UNIVERSITAS TELKOM PURWOKERTO\*\*



\*\*2026\*\*



</div>



\---



\## 1. Dasar Teori



\*\*PHP\*\* adalah bahasa server side scripting yaitu teknologi pemrograman dimana script atau programnya dikompilasi dan diterjemahkan di sisi server. Fungsi utamanya untuk menerima permintaan dari browser dan mengirimkan kembali hasilnya dalam bentuk halaman web (HTML). Berikut merupakan variabel yang digunakan untuk menyimpan nilai, data, atau informasi:

\- Simbol: Nama variabel selalu diawali dengan tanda `$`.

\- Aturan Nama: Harus diawali huruf atau underscore (\_), tidak boleh mengandung spasi, dan bersifat case sensitive (membedakan huruf besar dan kecil).

\- Tipe Data: PHP mendukung 8 tipe data primitif, di antaranya: Boolean, Integer, Float, String, Array, Object, Resource, dan NULL.



\---



\## 2. Source Code

```php

<?php

// DATA MAHASISWA

$mahasiswa = \[

&#x20;   \[

&#x20;       "nama"        => "Reli Gita Nurhidayati",

&#x20;       "nim"         => "2311102025",

&#x20;       "nilai\_tugas" => 88,

&#x20;       "nilai\_uts"   => 90,

&#x20;       "nilai\_uas"   => 92,

&#x20;   ],

&#x20;   \[

&#x20;       "nama"        => "Budi Setiawan",

&#x20;       "nim"         => "2311102026",

&#x20;       "nilai\_tugas" => 75,

&#x20;       "nilai\_uts"   => 70,

&#x20;       "nilai\_uas"   => 68,

&#x20;   ],

&#x20;   \[

&#x20;       "nama"        => "Siti Aminah",

&#x20;       "nim"         => "2311102027",

&#x20;       "nilai\_tugas" => 60,

&#x20;       "nilai\_uts"   => 55,

&#x20;       "nilai\_uas"   => 58,

&#x20;   ],

];



// FUNCTION HITUNG NILAI AKHIR

function hitungNilaiAkhir($tugas, $uts, $uas) {

&#x20;   $nilai\_akhir = ($tugas \* 0.30) + ($uts \* 0.35) + ($uas \* 0.35);

&#x20;   return round($nilai\_akhir, 2);

}



// FUNCTION TENTUKAN GRADE

function tentukanGrade($nilai) {

&#x20;   if ($nilai >= 85) {

&#x20;       return "A";

&#x20;   } elseif ($nilai >= 75) {

&#x20;       return "B";

&#x20;   } elseif ($nilai >= 65) {

&#x20;       return "C";

&#x20;   } elseif ($nilai >= 50) {

&#x20;       return "D";

&#x20;   } else {

&#x20;       return "E";

&#x20;   }

}



// FUNCTION TENTUKAN STATUS

function tentukanStatus($nilai) {

&#x20;   if ($nilai >= 65) {

&#x20;       return "LULUS";

&#x20;   } else {

&#x20;       return "TIDAK LULUS";

&#x20;   }

}



// PROSES DATA DENGAN LOOP

$total\_nilai     = 0;

$nilai\_tertinggi = 0;

$nama\_tertinggi  = "";



foreach ($mahasiswa as \&$mhs) {

&#x20;   $na = hitungNilaiAkhir($mhs\["nilai\_tugas"], $mhs\["nilai\_uts"], $mhs\["nilai\_uas"]);

&#x20;   $mhs\["nilai\_akhir"] = $na;

&#x20;   $mhs\["grade"]       = tentukanGrade($na);

&#x20;   $mhs\["status"]      = tentukanStatus($na);

&#x20;   $total\_nilai += $na;

&#x20;   if ($na > $nilai\_tertinggi) {

&#x20;       $nilai\_tertinggi = $na;

&#x20;       $nama\_tertinggi  = $mhs\["nama"];

&#x20;   }

}

unset($mhs);



$jumlah    = count($mahasiswa);

$rata\_rata = round($total\_nilai / $jumlah, 2);



$lulus = 0;

foreach ($mahasiswa as $m) {

&#x20;   if ($m\["status"] === "LULUS") $lulus++;

}

?>

```



\---



\## 3. Penjelasan Kode



Program menyimpan data mahasiswa ke dalam \*\*Array Asosiatif\*\* `$mahasiswa`, dimana setiap elemen memiliki kunci spesifik seperti nama, NIM, dan komponen nilai (Tugas, UTS, UAS). Pengolahan data dilakukan menggunakan tiga fungsi utama:



\- `hitungNilaiAkhir()` — menghitung nilai akhir dengan rumus: \*\*(Tugas × 30%) + (UTS × 35%) + (UAS × 35%)\*\*

\- `tentukanGrade()` — mengklasifikasikan nilai angka ke indeks huruf menggunakan kondisi If-Else dengan threshold: A (≥85), B (≥75), C (≥65), D (≥50), E (<50)

\- `tentukanStatus()` — menentukan status kelulusan, mahasiswa dinyatakan \*\*LULUS\*\* jika nilai akhir ≥ 65



Proses penyajian data menggunakan perulangan `foreach` yang secara iteratif memproses setiap data mahasiswa dan menampilkannya dalam Tabel HTML. Program juga menghitung statistik kelas seperti rata-rata nilai, nilai tertinggi, dan jumlah mahasiswa yang lulus.



\---



\## 4. Hasil



<div align="center">

&#x20; <img src="Screenshoot hasil tugas 9.png" width="700">

</div>

