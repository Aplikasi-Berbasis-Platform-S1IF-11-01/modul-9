<?php require_once 'penilaian.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Penilaian Mahasiswa - Modul 9 PHP - Qonita Rahayu Atmi">
    <title>Sistem Penilaian Mahasiswa | Modul 9 PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div style="max-width:1100px; margin:0 auto;">

    <!-- Hero -->
    <div class="hero">
        <div class="badge">Modul 9 &mdash; PHP</div>
        <h1>Sistem Penilaian Mahasiswa</h1>
        <p>2311102128 &bull; Qonita Rahayu Atmi &bull; S1 IF-11-REG01</p>
    </div>

    <!-- Stat Cards -->
    <div class="stat-grid">
        <div class="stat-card purple">
            <div class="label">Jumlah Mahasiswa</div>
            <div class="value"><?= $jumlah_mahasiswa ?></div>
            <div class="sub">Total peserta kelas</div>
        </div>
        <div class="stat-card green">
            <div class="label">Rata-rata Kelas</div>
            <div class="value"><?= $rata_rata ?></div>
            <div class="sub">Nilai rata-rata keseluruhan</div>
        </div>
        <div class="stat-card yellow">
            <div class="label">Nilai Tertinggi</div>
            <div class="value"><?= $nilai_tertinggi ?></div>
            <div class="sub"><?= htmlspecialchars($nama_tertinggi) ?></div>
        </div>
    </div>

    <!-- Bobot Penilaian -->
    <p class="section-title">Rekap Nilai Mahasiswa</p>
    <div class="bobot-info">
        <div class="bobot-chip">Bobot Tugas: <strong>30%</strong></div>
        <div class="bobot-chip">Bobot UTS: <strong>35%</strong></div>
        <div class="bobot-chip">Bobot UAS: <strong>35%</strong></div>
        <div class="bobot-chip">Lulus jika Nilai Akhir &ge; <strong>65</strong></div>
    </div>

    <!-- Tabel HTML -->
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Tugas</th>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th>Nilai Akhir</th>
                    <th>Grade</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($mahasiswa as $mhs) :
                    $grade        = $mhs["grade"];
                    $status       = $mhs["status"];
                    $status_class = ($status === "LULUS") ? "status-lulus" : "status-tidak-lulus";
                ?>
                <tr>
                    <td class="rank"><?= $no++ ?></td>
                    <td><strong><?= htmlspecialchars($mhs["nama"]) ?></strong></td>
                    <td style="color:var(--text-muted); font-size:.85rem;"><?= htmlspecialchars($mhs["nim"]) ?></td>
                    <td><?= $mhs["nilai_tugas"] ?></td>
                    <td><?= $mhs["nilai_uts"] ?></td>
                    <td><?= $mhs["nilai_uas"] ?></td>
                    <td><span class="na-value"><?= $mhs["nilai_akhir"] ?></span></td>
                    <td>
                        <span class="grade-badge grade-<?= $grade ?>"><?= $grade ?></span>
                    </td>
                    <td>
                        <span class="status-badge <?= $status_class ?>">
                            <span class="dot"></span>
                            <?= $status ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr style="background:var(--bg-header); border-top: 2px solid var(--border);">
                    <td colspan="6" style="padding:.9rem 1.25rem; font-weight:600; color:var(--text-muted); font-size:.85rem;">
                        Rata-rata Kelas
                    </td>
                    <td><span class="na-value"><?= $rata_rata ?></span></td>
                    <td colspan="2" style="color:var(--text-muted); font-size:.82rem;">
                        Tertinggi: <strong style="color:var(--yellow)"><?= $nilai_tertinggi ?></strong>
                        (<?= htmlspecialchars($nama_tertinggi) ?>)
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="legend">
        <span class="legend-title">Keterangan Grade:</span>
        <span class="grade-badge grade-A">A &ge;85</span>
        <span class="grade-badge grade-B">B &ge;75</span>
        <span class="grade-badge grade-C">C &ge;65</span>
        <span class="grade-badge grade-D">D &ge;55</span>
        <span class="grade-badge grade-E">E &lt;55</span>
    </div>

    <footer>
        <p>Dibuat oleh <span>Qonita Rahayu Atmi</span> &mdash; NIM <span>2311102128</span> &mdash; Modul 9 PHP</p>
        <p style="margin-top:.3rem;">Aplikasi Berbasis Platform &bull; Telkom University Purwokerto &bull; 2026</p>
    </footer>

</div>

</body>
</html>
