<!-- 2311102191 -->
<!-- FAHREZA ILHAM WICAKSONO -->
<!-- 👍🏿 -->

<?php

$students = [
    [
        "nama" => "Fahreza Ilham Wicaksono",
        "nim" => "2311102191",
        "nilai_tugas" => 85,
        "nilai_uts" => 90,
        "nilai_uas" => 80,
    ],
    [
        "nama" => "Andika Neviantoro",
        "nim" => "2311102167",
        "nilai_tugas" => 90,
        "nilai_uts" => 95,
        "nilai_uas" => 85,
    ],
    [
        "nama" => "Irshad Benaya Fardeca",
        "nim" => "2311102199",
        "nilai_tugas" => 80,
        "nilai_uts" => 90,
        "nilai_uas" => 90,
    ],
    [
        "nama" => "Andreas Besar Wibowo",
        "nim" => "2311102198",
        "nilai_tugas" => 85,
        "nilai_uts" => 95,
        "nilai_uas" => 90,
    ],
    [
        "nama" => "Budiono Siregar",
        "nim" => "2311102999",
        "nilai_tugas" => 60,
        "nilai_uts" => 50,
        "nilai_uas" => 40,
    ],
    [
        "nama" => "Keanu Reeves",
        "nim" => "2311102899",
        "nilai_tugas" => 75,
        "nilai_uts" => 85,
        "nilai_uas" => 50,
    ],
];

function hitungNilaiAkhir($tugas, $uts, $uas): float
{
    return ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
}

function tentukanGrade($nilai): string
{
    if ($nilai >= 85) {
        return "A";
    } elseif ($nilai >= 80 && $nilai < 85) {
        return "AB";
    } elseif ($nilai >= 75 && $nilai < 80) {
        return "B";
    } elseif ($nilai >= 70 && $nilai < 75) {
        return "BC";
    } elseif ($nilai >= 65 && $nilai < 70) {
        return "C";
    } elseif ($nilai >= 50 && $nilai < 65) {
        return "D";
    } else {
        return "E";
    }
}

function isLulus($nilaiAkhir): bool
{
    if ($nilaiAkhir >= 50) {
        return true;
    } else {
        return false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>

    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='80'>🎓</text></svg>">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fontawesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="mb-0">
                    <i class="fas fa-graduation-cap me-2"></i>Data Nilai Mahasiswa
                </h3>
            </div>

            <div class="card-body p-4">
                <div class="table-responsive">
                    <table id="tabelMahasiswa" class="table table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th class="align-middle text-center">Nilai Akhir</th>
                                <th class="align-middle text-center">Grade</th>
                                <th class="align-middle text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalNilai = 0;
                            $nilaiTertinggi = 0;

                            foreach ($students as $student) :
                                $nilaiAkhir = hitungNilaiAkhir(
                                    $student['nilai_tugas'],
                                    $student['nilai_uts'],
                                    $student['nilai_uas']
                                );

                                $grade = tentukanGrade($nilaiAkhir);
                                $status = isLulus($nilaiAkhir) ? "Lulus" : "Tidak Lulus";

                                $totalNilai += $nilaiAkhir;

                                if ($nilaiAkhir > $nilaiTertinggi) {
                                    $nilaiTertinggi = $nilaiAkhir;
                                }
                            ?>
                                <tr>
                                    <td class="fw-semibold"><?= $student['nama']; ?></td>
                                    <td><?= $student['nim']; ?></td>

                                    <td class="align-middle text-center">
                                        <span class="badge bg-info text-dark fw-bold px-3 py-2">
                                            <?= number_format($nilaiAkhir, 2); ?>
                                        </span>
                                    </td>

                                    <td class="align-middle text-center">
                                        <span class="badge bg-warning text-dark fw-bold px-3 py-2">
                                            <?= $grade; ?>
                                        </span>
                                    </td>

                                    <td class="align-middle text-center">
                                        <span class="badge <?= $status == 'Lulus' ? 'bg-success' : 'bg-danger'; ?> px-3 py-2">
                                            <i class="fas <?= $status == 'Lulus' ? 'fa-check' : 'fa-times'; ?>"></i>
                                            <?= $status; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <?php
                $rataRata = $totalNilai / count($students);
                ?>

                <div class="row text-center mt-4">
                    <div class="col-md-6 mb-3">
                        <div class="card border-0 shadow-sm bg-light">
                            <div class="card-body">
                                <h6 class="text-muted">
                                    <i class="fas fa-chart-line"></i> Rata-rata Kelas
                                </h6>

                                <h4 class="fw-bold text-primary">
                                    <?= number_format($rataRata, 2); ?>
                                </h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="card border-0 shadow-sm bg-light">
                            <div class="card-body">
                                <h6 class="text-muted">
                                    <i class="fas fa-trophy"></i> Nilai Tertinggi
                                </h6>

                                <h4 class="fw-bold text-success">
                                    <?= number_format($nilaiTertinggi, 2); ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        $("#tabelMahasiswa").DataTable({
            stateSave: true,
        });
    });
</script>

</html>