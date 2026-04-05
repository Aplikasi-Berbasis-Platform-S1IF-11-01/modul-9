<?php
$mahasiswa = [
    ["nama"=>"Bayu Kuncoro Adi","nim"=>"2311102031","tugas"=>97,"uts"=>96,"uas"=>94],
    ["nama"=>"Budi Gunadi Sadikin","nim"=>"2311109079","tugas"=>60,"uts"=>65,"uas"=>70],
    ["nama"=>"Citra Dewi Puspita","nim"=>"2311107987","tugas"=>80,"uts"=>75,"uas"=>92],
    ["nama"=>"Alex Sugeng Casmito","nim"=>"2311104347","tugas"=>60,"uts"=>50,"uas"=>40],
    ["nama"=>"Adinata Subandoro","nim"=>"2311107287","tugas"=>70,"uts"=>62,"uas"=>52]
];

function hitungNilaiAkhir($t,$u,$ua){
    return ($t*0.3)+($u*0.3)+($ua*0.4);
}

function grade($n){
    if($n>=85) return "A";
    elseif($n>=75) return "B";
    elseif($n>=65) return "C";
    elseif($n>=50) return "D";
    else return "E";
}

function status($n){
    return ($n>=65) ? "Lulus" : "Tidak Lulus";
}

$total = 0;
$max = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Penilaian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #e0f7fa, #ffffff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            border-radius: 20px;
            border: none;
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            color: white;
        }

        .badge-grade {
            font-size: 14px;
            padding: 6px 10px;
        }

        .title {
            font-weight: bold;
            color: #333;
        }

        .summary-box {
            border-radius: 15px;
            font-size: 18px;
            font-weight: 500;
        }
    </style>
</head>

<body>

<div class="container mt-5">
    <h2 class="text-center mb-4 title">Sistem Penilaian Mahasiswa - Bayu Kuncoro Adi (2311102031)</h2>

    <div class="card shadow-lg p-3">
        <div class="card-body">
            <table class="table table-hover text-center align-middle">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Nilai Akhir</th>
                        <th>Grade</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach($mahasiswa as $m){
                    $na = hitungNilaiAkhir($m['tugas'],$m['uts'],$m['uas']);
                    $g = grade($na);
                    $s = status($na);

                    $total += $na;
                    if($na > $max) $max = $na;

                    // warna grade
                    $warnaGrade = match($g) {
                        "A" => "bg-success",
                        "B" => "bg-primary",
                        "C" => "bg-warning text-dark",
                        "D" => "bg-orange text-dark",
                        default => "bg-danger"
                    };
                ?>
                    <tr>
                        <td><?= $m['nama'] ?></td>
                        <td><?= $m['nim'] ?></td>
                        <td><b><?= number_format($na,2) ?></b></td>
                        <td>
                            <span class="badge <?= $warnaGrade ?> badge-grade"><?= $g ?></span>
                        </td>
                        <td>
                            <span class="badge <?= ($s=="Lulus")?'bg-success':'bg-danger' ?> badge-grade">
                                <?= $s ?>
                            </span>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>

    <?php $avg = $total / count($mahasiswa); ?>

    <div class="row text-center mt-4">
        <div class="col-md-6">
            <div class="alert alert-primary shadow summary-box">
                📊 Rata-rata Kelas <br>
                <b><?= number_format($avg,2) ?></b>
            </div>
        </div>
        <div class="col-md-6">
            <div class="alert alert-success shadow summary-box">
                🏆 Nilai Tertinggi <br>
                <b><?= number_format($max,2) ?></b>
            </div>
        </div>
    </div>
</div>

</body>
</html>