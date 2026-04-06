<div align="center">
  <br />
  <h1>LAPORAN PRAKTIKUM <br>APLIKASI BERBASIS PLATFORM</h1>
  <br />
  <h3>MODUL 9 PHP<br>  Sistem Penilaian Mahasiswa </h3>
  <br />
  <img src="assets/Logo_Telkom_University_potrait.png" alt="Logo" width="300"> 
  <br />
  <br />
  <br />
  <h3>Disusun Oleh :</h3>
  <p>
    <strong>Arjun Werdho Kumoro</strong><br>
    <strong>2311102009</strong><br>
    <strong>IF-11-REG01</strong>
  </p>
  <br />
  <h3>Dosen Pengampu :</h3>
  <p>
    <strong>Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom</strong>
  </p>
  <br />
  <br />
    <h4>Asisten Praktikum :</h4>
    <strong> Apri Pandu Wicaksono </strong> <br>
    <strong>Rangga Pradarrell Fathi</strong>
  <br />
  <h3>LABORATORIUM HIGH PERFORMANCE
 <br>FAKULTAS INFORMATIKA <br>UNIVERSITAS TELKOM PURWOKERTO <br>2026</h3>
</div>

---

## 1.  Source Code
```
<?php
define('BOBOT_TUGAS', 0.30);
define('BOBOT_UTS', 0.35);
define('BOBOT_UAS', 0.35);

// Data Mahasiswa (10 orang)
$mahasiswa = [
    ["nama" => "Arjun Werdho Kumoro", "nim" => "2311102009", "nilai_tugas" => 70, "nilai_uts" => 65, "nilai_uas" => 60],
    ["nama" => "Raka Pratama", "nim" => "2311102002", "nilai_tugas" => 85, "nilai_uts" => 80, "nilai_uas" => 88],
    ["nama" => "Dimas Saputra", "nim" => "2311102003", "nilai_tugas" => 78, "nilai_uts" => 75, "nilai_uas" => 72],
    ["nama" => "Fajar Nugroho", "nim" => "2311102004", "nilai_tugas" => 90, "nilai_uts" => 92, "nilai_uas" => 95],
    ["nama" => "Rizky Ramadhan", "nim" => "2311102005", "nilai_tugas" => 60, "nilai_uts" => 58, "nilai_uas" => 62],
    ["nama" => "Bagas Setiawan", "nim" => "2311102006", "nilai_tugas" => 88, "nilai_uts" => 84, "nilai_uas" => 86],
    ["nama" => "Agus Salim", "nim" => "2311102007", "nilai_tugas" => 55, "nilai_uts" => 50, "nilai_uas" => 52],
    ["nama" => "Ilham Maulana", "nim" => "2311102008", "nilai_tugas" => 82, "nilai_uts" => 78, "nilai_uas" => 80],
    ["nama" => "Yusuf Hidayat", "nim" => "2311102009", "nilai_tugas" => 76, "nilai_uts" => 74, "nilai_uas" => 79],
    ["nama" => "Farhan Akbar", "nim" => "2311102010", "nilai_tugas" => 92, "nilai_uts" => 90, "nilai_uas" => 94],
];

function hitungNilaiAkhir($tugas, $uts, $uas) {
    return ($tugas * BOBOT_TUGAS) + ($uts * BOBOT_UTS) + ($uas * BOBOT_UAS);
}

function tentukanGrade($nilai) {
    if ($nilai >= 85) return "A";
    elseif ($nilai >= 75) return "B";
    elseif ($nilai >= 65) return "C";
    elseif ($nilai >= 55) return "D";
    else return "E";
}

$totalNilai = 0;
$nilaiTertinggi = 0;
$mhsTerbaik = "";

$hasil = [];

foreach ($mahasiswa as $mhs) {
    $akhir = hitungNilaiAkhir($mhs["nilai_tugas"], $mhs["nilai_uts"], $mhs["nilai_uas"]);
    $totalNilai += $akhir;

    if ($akhir > $nilaiTertinggi) {
        $nilaiTertinggi = $akhir;
        $mhsTerbaik = $mhs["nama"];
    }

    $hasil[] = [
        "nama" => $mhs["nama"],
        "nim" => $mhs["nim"],
        "tugas" => $mhs["nilai_tugas"],
        "uts" => $mhs["nilai_uts"],
        "uas" => $mhs["nilai_uas"],
        "akhir" => round($akhir, 2),
        "grade" => tentukanGrade($akhir),
        "status" => ($akhir >= 60) ? "LULUS" : "TIDAK LULUS"
    ];
}

$rataRata = round($totalNilai / count($mahasiswa), 2);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        body {
            font-family: Arial;
            background: #eef2f7;
            padding: 20px;
        }
        .container {
            max-width: 1100px;
            margin: auto;
        }
        h1 {
            text-align: center;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
            text-align: center;
        }
        th {
            background: #333;
            color: white;
        }
        .lulus {
            color: green;
            font-weight: bold;
        }
        .tidak {
            color: red;
            font-weight: bold;
        }
        .stats {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Sistem Penilaian Mahasiswa</h1>

    <div class="card stats">
        <div>Total Mahasiswa: <b><?= count($mahasiswa) ?></b></div>
        <div>Rata-rata: <b><?= $rataRata ?></b></div>
        <div>Tertinggi: <b><?= $nilaiTertinggi ?> (<?= $mhsTerbaik ?>)</b></div>
    </div>

    <div class="card">
        <table>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Tugas</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Nilai Akhir</th>
                <th>Grade</th>
                <th>Status</th>
            </tr>

            <?php foreach ($hasil as $h): ?>
            <tr>
                <td><?= $h["nama"] ?></td>
                <td><?= $h["nim"] ?></td>
                <td><?= $h["tugas"] ?></td>
                <td><?= $h["uts"] ?></td>
                <td><?= $h["uas"] ?></td>
                <td><?= $h["akhir"] ?></td>
                <td><?= $h["grade"] ?></td>
                <td class="<?= $h["status"] == "LULUS" ? "lulus" : "tidak" ?>">
                    <?= $h["status"] ?>
                </td>
            </tr>
            <?php endforeach; ?>

        </table>
    </div>
</div>

</body>
</html>
```


---
## 2. HASIL OUTPUT
![Hasilnya](assets\ssoutput.png)

---
## 3. PENJELASAN

Program sistem penilaian mahasiswa ini dibuat menggunakan bahasa pemrograman PHP untuk mengolah data nilai mahasiswa secara otomatis. Pada bagian awal program ditentukan konstanta bobot penilaian yang terdiri dari nilai tugas sebesar 30%, nilai UTS sebesar 35%, dan nilai UAS sebesar 35%. Selanjutnya, data mahasiswa disimpan dalam bentuk array asosiatif yang memuat informasi seperti nama, NIM, nilai tugas, nilai UTS, dan nilai UAS. Data ini menjadi dasar dalam proses perhitungan nilai akhir.

Perhitungan nilai akhir dilakukan melalui sebuah fungsi bernama hitungNilaiAkhir(), yang menggunakan operasi aritmatika untuk mengalikan setiap komponen nilai dengan bobotnya masing-masing, kemudian menjumlahkannya. Selain itu, terdapat fungsi tentukanGrade() yang digunakan untuk menentukan grade mahasiswa berdasarkan nilai akhir dengan menggunakan struktur percabangan if/else. Kriteria penilaian yang digunakan yaitu grade A untuk nilai ≥ 85, B untuk nilai ≥ 75, C untuk nilai ≥ 65, D untuk nilai ≥ 55, dan E untuk nilai di bawah 55.

Proses pengolahan data dilakukan menggunakan perulangan foreach untuk mengakses setiap data mahasiswa. Di dalam perulangan tersebut, program menghitung nilai akhir, menentukan grade, serta menetapkan status kelulusan menggunakan operator perbandingan, dimana mahasiswa dinyatakan lulus jika nilai akhirnya ≥ 60, dan tidak lulus jika di bawah itu. Selain itu, program juga menghitung total nilai untuk mendapatkan rata-rata kelas serta mencari nilai tertinggi dan mahasiswa dengan nilai terbaik.

Hasil dari pengolahan data tersebut kemudian ditampilkan dalam bentuk tabel HTML yang berisi informasi lengkap setiap mahasiswa, seperti nama, NIM, nilai tugas, UTS, UAS, nilai akhir, grade, dan status kelulusan. Tampilan juga dilengkapi dengan informasi tambahan berupa jumlah mahasiswa, rata-rata nilai kelas, serta nilai tertinggi yang dicapai. Dengan demikian, program ini tidak hanya memenuhi seluruh ketentuan tugas, tetapi juga mampu menyajikan informasi secara sistematis, rapi, dan mudah dipahami.
