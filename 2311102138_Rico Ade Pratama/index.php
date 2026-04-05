<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --bg-color: #f3f4f6;
            --card-bg: #ffffff;
            --text-main: #1f2937;
            --text-muted: #6b7280;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }

        .container {
            background-color: var(--card-bg);
            width: 100%;
            max-width: 1000px; /* Diperlebar sedikit karena kolom bertambah */
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            padding: 30px;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e5e7eb;
        }

        .header h2 {
            color: var(--primary);
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header p {
            color: var(--text-muted);
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            padding: 12px 10px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        th {
            background-color: #f9fafb;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.05em;
        }

        tbody tr:hover {
            background-color: #f9fafb;
            transition: background-color 0.2s;
        }

        .text-center { text-align: center; }

        /* Styling Badges */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            text-align: center;
            min-width: 80px;
        }

        .badge-lulus { background-color: #d1fae5; color: #065f46; }
        .badge-gagal { background-color: #fee2e2; color: #991b1b; }
        
        .grade-a { color: var(--success); font-weight: bold; }
        .grade-b { color: var(--primary); font-weight: bold; }
        .grade-c { color: var(--warning); font-weight: bold; }
        .grade-d, .grade-e { color: var(--danger); font-weight: bold; }

        /* Summary Cards */
        .summary-container {
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }

        .summary-card {
            flex: 1;
            background: linear-gradient(135deg, var(--primary), var(--primary-hover));
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3);
        }

        .summary-card.highest {
            background: linear-gradient(135deg, var(--success), #059669);
            box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3);
        }

        .summary-card h4 {
            font-size: 14px;
            font-weight: 500;
            opacity: 0.9;
            margin-bottom: 8px;
        }

        .summary-card .value {
            font-size: 28px;
            font-weight: 700;
        }

    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h2>Sistem Penilaian Akademik</h2>
            <p>Rekapitulasi Nilai Akhir & Status Kelulusan Mahasiswa</p>
        </div>

        <?php
        // 1. Array Asosiasi dengan 5 Mahasiswa (Grade A, B, C, D, E)
        $data_mahasiswa = [
            [
                "nama" => "Rico Ade Pratama", // Grade A
                "nim" => "2311102138",
                "nilai_tugas" => 90,
                "nilai_uts" => 88,
                "nilai_uas" => 92
            ],
            [
                "nama" => "Lionel Messi", // Grade B
                "nim" => "2311102666",
                "nilai_tugas" => 82,
                "nilai_uts" => 78,
                "nilai_uas" => 80
            ],
            [
                "nama" => "Cristiano Ronaldo", // Grade C
                "nim" => "2311102667",
                "nilai_tugas" => 70,
                "nilai_uts" => 65,
                "nilai_uas" => 55
            ],
            [
                "nama" => "Kylian Mbappe", // Grade D
                "nim" => "2311102668",
                "nilai_tugas" => 60,
                "nilai_uts" => 50,
                "nilai_uas" => 50
            ],
            [
                "nama" => "Andre Onana", // Grade E
                "nim" => "2311102669",
                "nilai_tugas" => 40,
                "nilai_uts" => 45,
                "nilai_uas" => 30
            ]
        ];

        // 2. Function & Operator Aritmatika (Tugas 30%, UTS 30%, UAS 40%)
        function hitungNilaiAkhir($tugas, $uts, $uas) {
            return ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);
        }

        // 3. Function & If/Else untuk Grade
        function tentukanGrade($nilaiAkhir) {
            if ($nilaiAkhir >= 85) {
                return ["grade" => "A", "class" => "grade-a"];
            } elseif ($nilaiAkhir >= 75) {
                return ["grade" => "B", "class" => "grade-b"];
            } elseif ($nilaiAkhir >= 60) {
                return ["grade" => "C", "class" => "grade-c"];
            } elseif ($nilaiAkhir >= 50) {
                return ["grade" => "D", "class" => "grade-d"];
            } else {
                return ["grade" => "E", "class" => "grade-e"];
            }
        }

        $total_nilai_kelas = 0;
        $nilai_tertinggi = 0;
        $jumlah_mahasiswa = count($data_mahasiswa);

        echo "<table>";
        // Tambahkan kolom Tugas, UTS, UAS di Header Tabel
        echo "<thead>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th class='text-center'>Tugas</th>
                    <th class='text-center'>UTS</th>
                    <th class='text-center'>UAS</th>
                    <th class='text-center'>Nilai Akhir</th>
                    <th class='text-center'>Grade</th>
                    <th class='text-center'>Status</th>
                </tr>
              </thead>
              <tbody>";

        // 4. Loop untuk menampilkan data
        foreach ($data_mahasiswa as $mhs) {
            $nilai_akhir = hitungNilaiAkhir($mhs['nilai_tugas'], $mhs['nilai_uts'], $mhs['nilai_uas']);
            
            $hasil_grade = tentukanGrade($nilai_akhir);
            $grade = $hasil_grade['grade'];
            $grade_class = $hasil_grade['class'];
            
            // 5. Operator Perbandingan untuk status lulus
            if ($nilai_akhir >= 60) {
                $status_html = "<span class='badge badge-lulus'>Lulus</span>";
            } else {
                $status_html = "<span class='badge badge-gagal'>Tidak Lulus</span>";
            }

            // Perhitungan Statistik
            $total_nilai_kelas += $nilai_akhir;
            if ($nilai_akhir > $nilai_tertinggi) {
                $nilai_tertinggi = $nilai_akhir;
            }

            // Render Baris Data (Sekarang menampilkan nilai Tugas, UTS, UAS)
            echo "<tr>";
            echo "<td><strong>" . htmlspecialchars($mhs['nama']) . "</strong></td>";
            echo "<td>" . htmlspecialchars($mhs['nim']) . "</td>";
            echo "<td class='text-center'>" . $mhs['nilai_tugas'] . "</td>";
            echo "<td class='text-center'>" . $mhs['nilai_uts'] . "</td>";
            echo "<td class='text-center'>" . $mhs['nilai_uas'] . "</td>";
            echo "<td class='text-center'>" . number_format($nilai_akhir, 2) . "</td>";
            echo "<td class='text-center " . $grade_class . "'>" . $grade . "</td>";
            echo "<td class='text-center'>" . $status_html . "</td>";
            echo "</tr>";
        }

        echo "</tbody></table>";

        // Hitung rata-rata
        $rata_rata_kelas = $total_nilai_kelas / $jumlah_mahasiswa;
        ?>

        <div class="summary-container">
            <div class="summary-card">
                <h4>Rata-rata Kelas</h4>
                <div class="value"><?php echo number_format($rata_rata_kelas, 2); ?></div>
            </div>
            <div class="summary-card highest">
                <h4>Nilai Tertinggi</h4>
                <div class="value"><?php echo number_format($nilai_tertinggi, 2); ?></div>
            </div>
        </div>

    </div>

</body>
</html>