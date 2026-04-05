<div align="center">
  <br />

  <h1>LAPORAN PRAKTIKUM <br>
  APLIKASI BERBASIS PLATFORM
  </h1>

  <br />

  <h3>MODUL IX <br>
 PHP
  </h3>

  <br />

  <img src="Images/Logo Telkom.png" alt="Logo" width="300">

  <br />
  <br />
  <br />

  <h3>Disusun Oleh :</h3>

  <p>
    <strong>Andreas Besar Wibowo</strong><br>
    <strong>2311102198</strong><br>
    <strong>S1 IF-11-REG01</strong>
  </p>

  <br />

  <h3>Dosen Pengampu :</h3>

  <p>
    <strong>Dimas Fanny Hebrasianto Permadi, S.ST., M.Kom</strong>
  </p>
  
  <br />
    <h4>Asisten Praktikum :</h4>
    <strong>Apri Pandu Wicaksono </strong> <br>
    <strong>Rangga Pradarrell Fathi</strong>
  <br />

  <h3>LABORATORIUM HIGH PERFORMANCE
 <br>FAKULTAS INFORMATIKA <br>UNIVERSITAS TELKOM PURWOKERTO <br>2026</h3>
</div>

<hr>

## Dasar Teori
### 1. Web Server dan Server Side Scripting
Web Server merupakan sebuah perangkat lunak dalam server yang berfungsi menerima permintaan(request) berupa halaman web melalui HTTP atau HTTPS dari client yang dikenal dengan web browser dan mengirimkan kembali (response) hasilnya dalam bentuk halaman-halaman web yang umumnya berbentuk dokumen HTML. 

Beberapa web server yang banyak digunakan antara lain seperti berikut:
1. Apache Web Server (https://httpd.apache.org/)
2. Internet Information Service, IIS (https://www.iis.net/)
3. Xitami Web Server
4. Sun Java System Web Server

Server Side Scripting merupakan sebuah teknologi scripting atau pemrograman web dimana script (program) dikompilasi atau diterjemahkan di server. Dengan server side scripting, memungkinkan untuk menghasilkan halaman web yang dinamis.

Beberapa contoh Server Side Scripting (Programming):
1. ASP (Active Server Page) dan ASP.NET
2. ColdFusion (http://www.adobe.com/products/coldfusion-family.html)
3. Java Server Pages (http://www.oracle.com/technetwork/java/javaee/jsp/index.html)
4. Perl (https://www.perl.org/)
5. Python (https://www.python.org/)
6. PHP (http://www.php.net/)

Keistimewaan PHP sebagai bahasa pemrograman berbasis web adalah :
1. Cepat
2. Free
3. Mudah dipelajari
4. Multi-platform
5. Dukungan technical support
6. Banyaknya komunitas PHP
7. Aman

### 2. Instalasi Apache, PHP dan MySQL dengan XAMPP
Proses instalasi Apache, PHP dan MySQL terkadang menjadi kendala tersendiri bagi yang ingin memulai belajar pemrograman web. Namun saat ini sudah tersedia banyak aplikasi paket yang mencakup ketiga aplikasi tersebut. Beberapa diantaranya adalah sebagai berikut:
1. XAMPP (versi windows) dan LAMPP (versi linux) yang dapat diunduh di https://www.apachefriends.org/download.html
2. WAMP Server 
3. APPServ 
4. PHPTriad

Pada modul ini, akan digunakan aplikasi paket XAMPP sebagai sarana pendukung dan pembelajaran pemrograman web.
a. Persiapan Instalasi 
1. Pastikan komputer anda tidak terinstall web server lain seperti IIS atau PWS karena dapat menyebabkan bentrok dengan web server Apache yang akan dipasang. Namun jika anda tetap ingin mempertahankannya, setelah installasi web server Apache selesai, anda dapat mengkonfigurasinya secara manual untuk mengganti nomor port yang akan digunakan oleh Apache.
2. Download source XAMPP versi 5.6.32 (yang akan digunakan di modul ini) pada https://www.apachefriends.org/download.html dan tersedia untuk sistem operasi Windows, Linux dan Mac.

b. Proses Instalasi
1. Jalankan file installer XAMPP 
2. Akan ditampilkan jendela instalasi XAMPP. Pilih Yes. Peringatan tersebut menunjukkan bahwa antivirus sedang berjalan dan tidak akan mengganggu proses instalasi. 
3. Setelah itu akan muncul jendela peringatan UAC (User Account Control). Klik OK.
4. Akan muncul jendela awal instalasi. Klik Next untuk melanjutkan instalasi. 
5. Jendela berikutnya adalah “Select Component”. Pada bagian ini kita bisa memilih aplikasi apa saja yang akan dipasang. Setelah selesai dipilih, klik Next untuk melanjutkan.
6. Selanjutnya adalah memilih lokasi dimana XAMPP akan dipasang. Jika sudah ditentukan lokasinya, klik next Next
7. Tampilan berikutnya adalah jendela “Bitnami for XAMPP”. Hilangkan centang pada bagian “Learn more about Bitnami for XAMPP”. Klik Next.
8. Jendela berikutnya adalah konfirmasi untuk mulai memasang XAMPP. Klik Next dan proses instalasi akan berlangsung.
9. Jika jendela “Completing the XAMPP Setup Wizard” telah tampil, maka proses instalasi XAMPP telah selesai. Centang bagian “Do you want to start the Control Panel now?” untuk menjalankan XAMPP. 
10. Akan muncul jendela Control Panel dari XAMPP. Pada bagian ini, kita bisa mengaktifkan serviceapa saja yang akan dijalankan dengan cara menekan tombol Start pada setiap service yang ada.
11.  Untuk mengujinya, buka web browser dan ketikkan alamat localhost pada address bar, kemudian tekan enter. Akan tampil jendela XAMPP yang menunjukkan bahwa proses instalasi dan service Apache berjalan dengan baik.

### 3. Pengenalan PHP
Merupakan singkatan rekursif dari PHP : Hypertext Preprocessor. Pertama kali diciptakan oleh Rasmus Lerdorf pada tahun 1994. PHP sendiri harus ditulis diantara tag :
- `<? dan ?>`
- `<?php dan ?>`
- `<script language=”php”> dan </script`
- `<% dan %>`

Setiap satu statement (perintah) biasanya diakhiri dengan titik-koma (;). PHP juga case sensitive untuk nama identifier yang dibuat oleh user sedangkan identifier bawaan dari PHP tidak case sensitive. Contoh program yang ditulis dengan bahasa PHP
`<?php echo “Hello World!”; ?>`
Simpan file tersebut dengan nama hello.php pada direktori htdocs yang ada di folder XAMPP. Kemudian, jalankan pada browser dengan mengetikkan alamat http://localhost/hello.php .

### 4. Variabel
Variabel digunakan untuk menyimpan sebuah value (nilai), data atau informasi. Nama variabel pada PHP diawali dengan tanda `$`. Panjang dari suatu variabel tidak terbatas dan variabel tidak perlu dideklarasi terlebih dahulu sebelumnya. Setelah tanda `$`, dapat diawali dengan huruf atau under-score (_). Karakter berikutnya bisa terdiri dari huruf, angka dan atau karakter tertentu yang diperbolehkan (karakter ASCII dari 127 – 255).

Variabel pada PHP bersifat case sensitive artinya besar kecilnya suatu karakter berpengaruh pada variabel tersebut. Suatu karakter pada PHP tidak boleh mengandung spasi.

Berikut adalah contoh penggunaan variabel pada PHP:
```php
<?php 
        $nim = “1301165454”; 
        $nama = “Baharudin”; 

        echo “NIM : “ . $nim; 
        echo “Nama : “ . $nama; 
?> 
```
Pada PHP, tipe data dari suatu variabel tidak didefinisikan langsung oleh programmer, akan tetapi secara otomatis akan ditentukan oleh interpreter PHP. Namun demikian, PHP mendukung 8 (delapan) buah tipe data primitif, yaitu:
1. Boolean
2. Integer
3. Float
4. String
5. Array
6. Object
7. Resource
8. NULL

### 5. Konstanta
Konstanta merupakan variabel konstan yang nilainya tidak berubah-ubah. Untuk mendefinisikan konstanta pada PHP, dapat menggunakan fungsi define() yang telah tersedia pada PHP. Berikut adalah contohnya : 
```php
<?php 
    define(“NAMA” , “Baharuddin”); 
    define(“NIM” , “1301165454”); 
    echo “Nama : “ . NAMA; 
    echo “NIM : “ . NIM; 
?
```

### 6. Operator dalam PHP
Ada beberapa jenis operator pada PHP, yaitu: 

**1. Operator Aritmatika, Digunakan untuk operasi perhitungan matematika.**

| Operator | Contoh    | Keterangan                |
| -------- | --------- | ------------------------- |
| `+`      | `$a + $b` | Penjumlahan               |
| `-`      | `$a - $b` | Pengurangan               |
| `*`      | `$a * $b` | Perkalian                 |
| `/`      | `$a / $b` | Pembagian                 |
| `%`      | `$a % $b` | Modulus (sisa hasil bagi) |

**2. Operator Penugasan, Digunakan untuk memberikan nilai ke variabel.**

| Operator | Contoh   | Keterangan                         |
| -------- | -------- | ---------------------------------- |
| `=`      | `$a = 4` | Variabel `$a` diisi dengan nilai 4 |

**3. Operator Bitwise, Digunakan untuk operasi level bit (biner).**

| Operator | Contoh     | Keterangan  |
| -------- | ---------- | ----------- |
| `&`      | `$a & $b`  | Bitwise AND |
| `\|`     | `$a \| $b` | Bitwise OR  |
| `^`      | `$a ^ $b`  | Bitwise XOR |
| `~`      | `~$a`      | Bitwise NOT |
| `<<`     | `$a << $b` | Shift Left  |
| `>>`     | `$a >> $b` | Shift Right |

**4. Operator Perbandingan, Digunakan untuk membandingkan dua nilai.**

| Operator    | Contoh      | Keterangan                  |
| ----------- | ----------- | --------------------------- |
| `==`        | `$a == $b`  | Sama dengan                 |
| `===`       | `$a === $b` | Identik (nilai & tipe sama) |
| `!=` / `<>` | `$a != $b`  | Tidak sama dengan           |
| `!==`       | `$a !== $b` | Tidak identik               |
| `<`         | `$a < $b`   | Kurang dari                 |
| `>`         | `$a > $b`   | Lebih dari                  |
| `<=`        | `$a <= $b`  | Kurang dari sama dengan     |
| `>=`        | `$a >= $b`  | Lebih dari sama dengan      |

**5. Operator Logika, Digunakan untuk operasi logika (boolean).**

| Operator      | Contoh       | Keterangan                                 |
| ------------- | ------------ | ------------------------------------------ |
| `and` / `&&`  | `$a && $b`   | TRUE jika keduanya TRUE                    |
| `or` / `\|\|` | `$a \|\| $b` | TRUE jika salah satu TRUE                  |
| `xor`         | `$a xor $b`  | TRUE jika salah satu TRUE (tidak keduanya) |
| `!`           | `!$a`        | TRUE jika `$a` FALSE                       |

**6. Operator String, Digunakan untuk manipulasi string.**

| Operator | Contoh    | Keterangan           |
| -------- | --------- | -------------------- |
| `.`      | `$a . $b` | Menggabungkan string |

### 7. Struktur Kondisi
Struktur kondisi pada PHP sama halnya dengan bahasa pemrograman lainnya seperti Java. Berikut adalah contoh penulisan struktur kondisi if-then pada PHP:
```java
if (kondisi) { 
    statement-jika-kondisi-TRUE; 
} else { 
    Statement-jika-kondisi-FALSE; } 
```

Selain struktur kondisi if-then, terdapat pula struktur kondisi switch-case seperti berikut :
```java
switch ($var) { 
    case ‘1’ : statement-1; break; case 
‘2’ : statement-2; break; 
    . . . . 
}
```

Berikut adalah contoh ketika statement kondisi if-then dijalankan :
```java
$nilai = 80; if ($nilai > 50) { 
    echo "Nilai Anda adalah " . $nilai . ". Selamat, Anda lulus"; 
} else { 
    echo "Nilai Anda adalah " . $nilai . ". Maaf, Anda tidak lulus"; 
}
```

Dan berikut ini adalah contoh ketika statement switch-case dijalankan :
```java
$nilai = 80; 
switch ($nilai) { 
    case ($nilai > 50 && $nilai <= 60) : echo "Nilai Anda adalah " . 
$nilai . ". Indeks nilai anda C"; break; 
    case ($nilai > 60 && $nilai <= 70) : echo "Nilai Anda adalah " 
.$nilai . ". Indeks nilai anda BC"; break; 
    case ($nilai > 70 && $nilai <= 75) : echo "Nilai Anda adalah " 
.$nilai . ". Indeks nilai anda B"; break; 
    case ($nilai > 75 && $nilai <= 80) : echo "Nilai Anda adalah " 
.$nilai . ". Indeks nilai anda AB"; break; 
    case ($nilai > 80 && $nilai <= 100) : echo "Nilai Anda adalah " 
.$nilai . ". Indeks nilai anda A"; break; 
    default : 
echo "Nilai Anda adalah " . $nilai . ". Maaf, Anda tidak lulus"; 
break; }
```

### 8. Perulangan (Looping)
Banyak jenis perulangan yang terdapat pada PHP. Adapun beberapa diantaranya adalah : 

**1. Perulangan for**
```java
for (init_awal, kondisi, counter) { 
    statement; 
} 
```

**2. Perulangan while**
```java
init_awal; while (kondisi) { 
    statement; 
    counter; 
} 
```

**3. Perulangan do-while**
```java
init_awal; 
do { 
    statement; counter; 
} while (kondisi);
```

**4. Perulangan foreach**
```java
foreach (array_expression as $value) {
    statement; 
} 
```

Berikut adalah contoh penggunaan perulangan : 
```php
<?php
echo "Ini adalah contoh perulangan for";
echo "<br>";

for ($i = 1; $i <= 10; $i++) {
    echo $i . " ";
}

echo "<br>";
echo "<br>";

echo "Ini adalah contoh perulangan while";
echo "<br>";

$i = 1;
while ($i <= 20) {
    echo $i . " ";
    $i += 2;
}

echo "<br>";
echo "<br>";

echo "Ini adalah contoh perulangan do-while";
echo "<br>";

$i = 1;
do {
    echo $i . " ";
    $i += 3;
} while ($i < 30);
?>
```

### 9. Function
Dalam merancang kode program, kadang kita sering membuat kode yang melakukan tugas yang sama secara berulang-ulang, seperti membaca tabel dari database, menampilkan penjumlahan, dan lainlain. Tugas yang sama ini akan lebih efektif jika dipisahkan dari program utama, dan dirancang menjadi sebuah fungsi.

Fungsi dipanggil dengan menulis nama dari fungsi tersebut, dan diikuti dengan argumen (jika ada). Argumen ditulis di dalam tanda kurung, dan jika jumlah argumen lebih dari satu, maka diantaranya dipisahkan oleh karakter koma. 

Bentuk umum pendefinisian fungsi pada PHP adalah sebagai berikut :
```php
function nama_fungsi(parameter1, parameter2, 
…. , n) { 
    statement; 
}
```

Contoh fungsi pada PHP tanpa menggunakan parameter dan return value: 
```php
<?php
function cetakGenap()
{
    for ($i = 1; $i <= 100; $i++) {
        if ($i % 2 == 0) {
            echo "$i ";
        }
    }
}

// pemanggilan fungsi
cetakGenap();
?>
```

Contoh fungsi pada PHP menggunakan parameter dan tanpa return value:
```php
<?php
function cetakGenap($awal, $akhir)
{
    for ($i = $awal; $i <= $akhir; $i++) {
        if ($i % 2 == 0) {
            echo "$i ";
        }
    }
}

// pemanggilan fungsi
$a = 10;
$b = 50;

echo "Bilangan ganjil dari $a sampai $b adalah : <br>";
cetakGenap($a, $b);
?>
```

Contoh fungsi pada PHP dengan return value:
```php
<?php
function luasSegitiga($alas, $tinggi)
{
    return 0.5 * $alas * $tinggi;
}

// pemanggilan fungsi
$a = 10;
$t = 50;

echo "Luas Segitiga dengan alas $a dan tinggi $t adalah : " . luasSegitiga($a, $t);
?>
```

### 10. Array 
Array merupakan tipe data terstruktur yang berguna untuk menyimpan sejumlah data yang bertipe sama. Bagian yang menyusun array disebut elemen array, yang masing-masing elemen dapat diakses tersendiri melalui index array. Index array dapat berupa bilangan integer atau string.

Untuk mendeklarasikan atau mendefinisikan sebuah array di PHP bisa menggunakan keyword array(). Jumlah elemen array tidak perlu disebutkan saat deklarasi. Sedangkan untuk menampilkan isi array pada elemen tertentu, cukup dengan menyebutkan nama array beserta index array-nya.

Berikut adalah cara mendeklarasikan suatu array di PHP :
```php
<?php
$arrKendaraan = ["Mobil", "Pesawat", "Kereta Api", "Kapal Laut"];

echo $arrKendaraan[0] . "<br>"; // Mobil
echo $arrKendaraan[2] . "<br>"; // Kereta Api

$arrKota = [];
$arrKota[] = "Jakarta";
$arrKota[] = "Medan";
$arrKota[] = "Bandung";
$arrKota[] = "Malang";
$arrKota[] = "Sulawesi";

echo $arrKota[1] . "<br>"; // Medan
echo $arrKota[2] . "<br>"; // Bandung
echo $arrKota[4] . "<br>"; // Sulawesi
?>
```

Cara mendeklarasikan suatu array pada PHP bisa dengan index string atau yang dinamakan dengan array assosiatif. Berikut adalah contoh pendeklarasian array assosiatif 
```php
<?php
$arrAlamat = [
    "Rona"  => "Banjarmasin",
    "Dhiva" => "Bandung",
    "Ilham" => "Medan",
    "Oku"   => "Hongkong",
];

echo $arrAlamat["Dhiva"] . "<br>"; // Bandung
echo $arrAlamat['Oku'] . "<br>";   // Hongkong

$arrNim = [];
$arrNim["Rona"]    = "11011112";
$arrNim["Dhiva"]   = "11011101";
$arrNim["Ilham"]   = "11011309";
$arrNim["Oku"]     = "11014765";
$arrNim["Fadhlan"] = "11011113";

echo $arrNim["Ilham"] . "<br>";   // 11011309
echo $arrNim['Fadhlan'] . "<br>"; // 11011113
?>
```

## Tugas | Buat Sistem Penilaian Mahasiswa
#### Deskripsi
Buat program PHP sederhana untuk menampilkan data beberapa mahasiswa, menghitung nilai akhir, menentukan grade, dan status kelulusan.

#### Ketentuan
Gunakan array Asosiasi untuk menyimpan minimal 3 data mahasiswa

#### Setiap mahasiswa punya:
* nama
* nim
* nilai tugas
* nilai uts
* nilai uas
* Gunakan function untuk menghitung nilai akhir
* Gunakan if/else atau switch untuk menentukan grade
* Gunakan operator aritmatika untuk perhitungan nilai akhir
* Gunakan operator perbandingan untuk menentukan lulus/tidak
* Gunakan loop untuk menampilkan seluruh data
* Tampilkan hasil dalam bentuk tabel HTML

#### Output minimal
* Nama
* NIM
* Nilai akhir
* Grade
* Status
* Tampilkan rata-rata kelas
* Tampilkan nilai tertinggi

#### Note
Jangan lupa source code serta SS hasil disertakan di repository github masing-masing yahh

### Jawaban
**index.php**
```php
<?php
// Andreas Besar Wibowo
// 2311102198 / IF-11-01

// Data Mahasiswa
$mahasiswa = [
    [
        "nama" => "Andreas Besar Wibowo",
        "nim" => "001",
        "tugas" => 90,
        "uts" => 88,
        "uas" => 85
    ],
    [
        "nama" => "Joko Susilo",
        "nim" => "002",
        "tugas" => 70,
        "uts" => 65,
        "uas" => 60
    ],
    [
        "nama" => "Indra Budiman",
        "nim" => "003",
        "tugas" => 90,
        "uts" => 70,
        "uas" => 92
    ],
    [
        "nama" => "Citra Sudirman",
        "nim" => "004",
        "tugas" => 50,
        "uts" => 40,
        "uas" => 30
    ]
];

// Fungsi hitung nilai akhir
function hitungNilaiAkhir($tugas, $uts, $uas)
{
    return (0.3 * $tugas) + (0.3 * $uts) + (0.4 * $uas);
}

// Fungsi menentukan grade
function tentukanGrade($nilai)
{
    if ($nilai > 85)
        return "A";
    elseif ($nilai > 75)
        return "AB";
    elseif ($nilai > 65)
        return "B";
    elseif ($nilai > 60)
        return "BC";
    elseif ($nilai > 50)
        return "C";
    elseif ($nilai > 40)
        return "D";
    else
        return "E";
}

// Variabel tambahan
$totalNilai = 0;
$nilaiTertinggi = 0;
?>

<!-- File HTML -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Sistem Penilaian Mahasiswa</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- Styling -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            border-radius: 8px;
            overflow: hidden;
        }

        th {
            background-color: #343a40;
            color: white;
            padding: 12px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .lulus {
            color: #28a745;
            font-weight: bold;
        }

        .tidak {
            color: #dc3545;
            font-weight: bold;
        }

        .summary {
            margin-top: 25px;
            text-align: center;
        }

        .card {
            display: inline-block;
            margin: 10px;
            padding: 15px 25px;
            border-radius: 8px;
            background: #f8f9fa;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .card strong {
            color: #555;
        }
    </style>
</head>

<body>

    <div class="container">

        <h2>Data Nilai Mahasiswa</h2>

        <table>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Nilai Akhir</th>
                <th>Grade</th>
                <th>Status</th>
            </tr>

            <?php foreach ($mahasiswa as $mhs): ?>
                <?php
                $nilaiAkhir = hitungNilaiAkhir($mhs["tugas"], $mhs["uts"], $mhs["uas"]);
                $grade = tentukanGrade($nilaiAkhir);
                $status = ($grade == "D" || $grade == "E") ? "Tidak Lulus" : "Lulus";

                $totalNilai += $nilaiAkhir;
                if ($nilaiAkhir > $nilaiTertinggi) {
                    $nilaiTertinggi = $nilaiAkhir;
                }
                ?>
                <tr>
                    <td><?= $mhs["nama"]; ?></td>
                    <td><?= $mhs["nim"]; ?></td>
                    <td><?= number_format($nilaiAkhir, 2); ?></td>
                    <td><?= $grade; ?></td>
                    <td class="<?= ($status == 'Lulus') ? 'lulus' : 'tidak'; ?>">
                        <?= $status; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <?php $rataRata = $totalNilai / count($mahasiswa); ?>

        <div class="summary">
            <div class="card">
                <strong>Rata-rata</strong><br>
                <?= number_format($rataRata, 2); ?>
            </div>

            <div class="card">
                <strong>Nilai Tertinggi</strong><br>
                <?= number_format($nilaiTertinggi, 2); ?>
            </div>
        </div>

    </div>

</body>

</html>
```

#### Penjelasan
**1. Deklarasi Data Mahasiswa**
```php
$mahasiswa = [
    [
        "nama" => "Andreas Besar Wibowo",
        "nim" => "001",
        "tugas" => 90,
        "uts" => 88,
        "uas" => 85
    ],
    ...
];
```
Penjelasan:
* Data mahasiswa disimpan dalam array multidimensi
* Setiap mahasiswa memiliki atribut: nama, NIM, nilai tugas, UTS, dan UAS
* Struktur ini memudahkan pengolahan data secara berulang (loop)

**2. Fungsi Menghitung Nilai Akhir**
```php
function hitungNilaiAkhir($tugas, $uts, $uas)
{
    return (0.3 * $tugas) + (0.3 * $uts) + (0.4 * $uas);
}
```
Penjelasan:
* Fungsi digunakan untuk menghitung nilai akhir mahasiswa
* Bobot penilaian:
    - Tugas = 30%
    - UTS = 30%
    - UAS = 40%
* Mengembalikan nilai dalam bentuk angka (float)

**3. Fungsi Menentukan Grade**
```php
function tentukanGrade($nilai)
{
    if ($nilai > 85)
        return "A";
    elseif ($nilai > 75)
        return "AB";
    elseif ($nilai > 65)
        return "B";
    elseif ($nilai > 60)
        return "BC";
    elseif ($nilai > 50)
        return "C";
    elseif ($nilai > 40)
        return "D";
    else
        return "E";
}
```
Penjelasan:
- Fungsi ini menentukan grade berdasarkan nilai akhir
- Menggunakan struktur if-elseif
- Rentang nilai dibagi menjadi A sampai E

**4. Perulangan Data Mahasiswa**
```php
<?php foreach ($mahasiswa as $mhs): ?>
```
Penjelasan:
- Menggunakan foreach untuk menampilkan data mahasiswa
- Setiap data diolah satu per satu
- Digunakan untuk menghasilkan tabel secara dinamis

**5. Perhitungan Nilai dan Status**
```php
$nilaiAkhir = hitungNilaiAkhir($mhs["tugas"], $mhs["uts"], $mhs["uas"]);
$grade = tentukanGrade($nilaiAkhir);
$status = ($grade == "D" || $grade == "E") ? "Tidak Lulus" : "Lulus";
```
Penjelasan:
- Nilai akhir dihitung menggunakan fungsi
- Grade ditentukan berdasarkan nilai
- Status kelulusan:
    - Lulus = selain D dan E
    - Tidak Lulus = jika D atau E

**6. Menampilkan Data ke Tabel HTML**
```HTML
<td><?= $mhs["nama"]; ?></td>
<td><?= $mhs["nim"]; ?></td>
<td><?= number_format($nilaiAkhir, 2); ?></td>
<td><?= $grade; ?></td>
```
Penjelasan:
- Data ditampilkan dalam bentuk tabel HTML
- `<?= ?>` adalah shorthand untuk echo
- `number_format()` digunakan untuk membatasi desimal

**7. Perhitungan Rata-rata dan Nilai Tertinggi**
```php
$totalNilai += $nilaiAkhir;

if ($nilaiAkhir > $nilaiTertinggi) {
    $nilaiTertinggi = $nilaiAkhir;
}

$rataRata = $totalNilai / count($mahasiswa);
```
Penjelasan:
- Total nilai dijumlahkan dari semua mahasiswa
- Nilai tertinggi dicari dengan perbandingan
- Rata-rata dihitung dari total nilai dibagi jumlah mahasiswa

**8. Operator perbandingan untuk menentukan lulus/tidak**
```php
$status = ($grade == "D" || $grade == "E") ? "Tidak Lulus" : "Lulus";
```
Penjelasan:
- Menggunakan operator perbandingan `==` untuk membandingkan nilai grade
- Menggunakan operator logika `||` (OR)
- Jika grade D atau E → Tidak Lulus, selain itu → Lulus

**9. Tampilan Ringkasan**
```php
<?= number_format($rataRata, 2); ?>
<?= number_format($nilaiTertinggi, 2); ?>
```
Penjelasan:
- Menampilkan hasil akhir:
    - Rata-rata nilai
    - Nilai tertinggi
- Ditampilkan dalam bentuk card UI

**10. Styling (CSS)**
```css
.container {
    max-width: 900px;
    margin: auto;
    background: #ffffff;
}
```
Penjelasan:
- Mengatur tampilan agar lebih menarik
- Menggunakan:
    - Font Google (Poppins)
    - Shadow dan border radius
- Memberikan tampilan modern dan rapi

### Hasil Output
![Output 1](Images/Output%201.png)
