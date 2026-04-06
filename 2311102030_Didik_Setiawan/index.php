<?php
$mahasiswa = [
    ["nama" => "Didik Setiawan",  "nim" => "2311102030", "tugas" => 85, "uts" => 78, "uas" => 82],
    ["nama" => "Budi",  "nim" => "2311110002", "tugas" => 70, "uts" => 65, "uas" => 60],
    ["nama" => "asep",    "nim" => "231110003", "tugas" => 92, "uts" => 88, "uas" => 95],
    ["nama" => "dodo",  "nim" => "2301010004", "tugas" => 55, "uts" => 50, "uas" => 48],
    ["nama" => "darma",     "nim" => "2401010005", "tugas" => 78, "uts" => 82, "uas" => 76],
];

function nilaiAkhir($t, $u, $a) { return ($t * 0.3) + ($u * 0.35) + ($a * 0.35); }
function grade($n) {
    if ($n >= 85) return "A";
    elseif ($n >= 75) return "B";
    elseif ($n >= 65) return "C";
    elseif ($n >= 55) return "D";
    else return "E";
}

$total = 0; $max = 0; $terbaik = "";
foreach ($mahasiswa as &$m) {
    $m["na"]     = round(nilaiAkhir($m["tugas"], $m["uts"], $m["uas"]), 2);
    $m["grade"]  = grade($m["na"]);
    $m["status"] = $m["na"] >= 60 ? "Lulus" : "Tidak Lulus";
    $total += $m["na"];
    if ($m["na"] > $max) { $max = $m["na"]; $terbaik = $m["nama"]; }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nilai Mahasiswa</title>
    <style>
        body { font-family: sans-serif; padding: 2rem; background: #f4f4f4; }
        h2   { margin-bottom: 1rem; }
        table { border-collapse: collapse; width: 100%; background: white; }
        th, td { border: 1px solid #ccc; padding: .6rem 1rem; text-align: center; }
        th   { background: #333; color: white; }
        tr:nth-child(even) { background: #f9f9f9; }
        .lulus  { color: green; font-weight: bold; }
        .gagal  { color: red;   font-weight: bold; }
        .info   { margin-top: 1rem; font-size: .95rem; }
    </style>
</head>
<body>
<h2>Data Nilai Mahasiswa</h2>
<table>
    <tr><th>#</th><th>Nama</th><th>NIM</th><th>Tugas</th><th>UTS</th><th>UAS</th><th>Nilai Akhir</th><th>Grade</th><th>Status</th></tr>
    <?php foreach ($mahasiswa as $i => $m): ?>
    <tr>
        <td><?= $i+1 ?></td>
        <td><?= $m["nama"] ?></td>
        <td><?= $m["nim"] ?></td>
        <td><?= $m["tugas"] ?></td>
        <td><?= $m["uts"] ?></td>
        <td><?= $m["uas"] ?></td>
        <td><?= $m["na"] ?></td>
        <td><?= $m["grade"] ?></td>
        <td class="<?= $m["status"]=='Lulus' ? 'lulus' : 'gagal' ?>"><?= $m["status"] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<div class="info">
    <p> Rata-rata kelas : <strong><?= round($total / count($mahasiswa), 2) ?></strong></p>
    <p> Nilai tertinggi : <strong><?= $max ?></strong> — <?= $terbaik ?></p>
</div>
</body>
</html>