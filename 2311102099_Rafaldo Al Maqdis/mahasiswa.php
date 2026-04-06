<?php
// ============================================================
// KONFIGURASI: File JSON sebagai "database" sederhana
// ============================================================
define('DATA_FILE', __DIR__ . '/mahasiswa_data.json');

// ── Inisialisasi file JSON jika belum ada ──────────────────
function initData() {
    if (!file_exists(DATA_FILE)) {
        $default = [
            ["id"=>1,"nama"=>"Aisyah Putri Ramadhani","nim"=>"2021001001","nilai_tugas"=>88,"nilai_uts"=>82,"nilai_uas"=>90],
            ["id"=>2,"nama"=>"Bima Sakti Nugraha",    "nim"=>"2021001002","nilai_tugas"=>75,"nilai_uts"=>68,"nilai_uas"=>72],
            ["id"=>3,"nama"=>"Citra Dewi Kusuma",      "nim"=>"2021001003","nilai_tugas"=>60,"nilai_uts"=>55,"nilai_uas"=>58],
            ["id"=>4,"nama"=>"Daffa Arya Wibisono",    "nim"=>"2021001004","nilai_tugas"=>92,"nilai_uts"=>95,"nilai_uas"=>91],
            ["id"=>5,"nama"=>"Elsa Nuraini Hasanah",   "nim"=>"2021001005","nilai_tugas"=>45,"nilai_uts"=>48,"nilai_uas"=>42],
        ];
        file_put_contents(DATA_FILE, json_encode($default, JSON_PRETTY_PRINT));
    }
}

// ── CRUD Helpers ───────────────────────────────────────────
function loadData()         { return json_decode(file_get_contents(DATA_FILE), true) ?: []; }
function saveData($data)    { file_put_contents(DATA_FILE, json_encode(array_values($data), JSON_PRETTY_PRINT)); }
function nextId($data)      { return $data ? max(array_column($data, 'id')) + 1 : 1; }

// ── Validasi input nilai (0–100) ───────────────────────────
function validasiNilai($v) { return is_numeric($v) && $v >= 0 && $v <= 100; }

// ── Sanitasi string input ──────────────────────────────────
function sanitize($s) { return htmlspecialchars(trim($s), ENT_QUOTES, 'UTF-8'); }

// ── Logic nilai ────────────────────────────────────────────
function hitungNilaiAkhir($tugas, $uts, $uas) {
    return round(($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4), 2);
}
function tentukanGrade($n) {
    if ($n >= 85) return 'A';
    elseif ($n >= 70) return 'B';
    elseif ($n >= 60) return 'C';
    elseif ($n >= 50) return 'D';
    else return 'E';
}
function tentukanStatus($n) { return ($n >= 60) ? 'Lulus' : 'Tidak Lulus'; }

// ============================================================
// PROSES FORM (POST) — CREATE / UPDATE / DELETE
// ============================================================
initData();
$flash = null;   // Pesan notifikasi

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $data   = loadData();

    // ── CREATE ─────────────────────────────────────────────
    if ($action === 'create') {
        $nama        = sanitize($_POST['nama'] ?? '');
        $nim         = sanitize($_POST['nim']  ?? '');
        $nilai_tugas = (float)($_POST['nilai_tugas'] ?? 0);
        $nilai_uts   = (float)($_POST['nilai_uts']   ?? 0);
        $nilai_uas   = (float)($_POST['nilai_uas']   ?? 0);

        $errors = [];
        if (empty($nama))                       $errors[] = "Nama tidak boleh kosong.";
        if (empty($nim))                        $errors[] = "NIM tidak boleh kosong.";
        // Cek duplikat NIM
        foreach ($data as $row) {
            if ($row['nim'] === $nim) { $errors[] = "NIM sudah terdaftar."; break; }
        }
        if (!validasiNilai($nilai_tugas))       $errors[] = "Nilai tugas harus 0–100.";
        if (!validasiNilai($nilai_uts))         $errors[] = "Nilai UTS harus 0–100.";
        if (!validasiNilai($nilai_uas))         $errors[] = "Nilai UAS harus 0–100.";

        if (empty($errors)) {
            $data[] = [
                'id'          => nextId($data),
                'nama'        => $nama,
                'nim'         => $nim,
                'nilai_tugas' => $nilai_tugas,
                'nilai_uts'   => $nilai_uts,
                'nilai_uas'   => $nilai_uas,
            ];
            saveData($data);
            $flash = ['type' => 'success', 'msg' => "✅ Mahasiswa <strong>$nama</strong> berhasil ditambahkan!"];
        } else {
            $flash = ['type' => 'danger', 'msg' => "❌ " . implode(' ', $errors)];
        }
    }

    // ── UPDATE ─────────────────────────────────────────────
    elseif ($action === 'update') {
        $id          = (int)($_POST['id'] ?? 0);
        $nama        = sanitize($_POST['nama'] ?? '');
        $nim         = sanitize($_POST['nim']  ?? '');
        $nilai_tugas = (float)($_POST['nilai_tugas'] ?? 0);
        $nilai_uts   = (float)($_POST['nilai_uts']   ?? 0);
        $nilai_uas   = (float)($_POST['nilai_uas']   ?? 0);

        $errors = [];
        if (empty($nama))              $errors[] = "Nama tidak boleh kosong.";
        if (empty($nim))               $errors[] = "NIM tidak boleh kosong.";
        // Cek duplikat NIM (kecuali diri sendiri)
        foreach ($data as $row) {
            if ($row['nim'] === $nim && $row['id'] !== $id) { $errors[] = "NIM sudah digunakan mahasiswa lain."; break; }
        }
        if (!validasiNilai($nilai_tugas)) $errors[] = "Nilai tugas harus 0–100.";
        if (!validasiNilai($nilai_uts))   $errors[] = "Nilai UTS harus 0–100.";
        if (!validasiNilai($nilai_uas))   $errors[] = "Nilai UAS harus 0–100.";

        if (empty($errors)) {
            foreach ($data as &$row) {
                if ($row['id'] === $id) {
                    $row['nama']        = $nama;
                    $row['nim']         = $nim;
                    $row['nilai_tugas'] = $nilai_tugas;
                    $row['nilai_uts']   = $nilai_uts;
                    $row['nilai_uas']   = $nilai_uas;
                    break;
                }
            }
            unset($row);
            saveData($data);
            $flash = ['type' => 'success', 'msg' => "✅ Data <strong>$nama</strong> berhasil diperbarui!"];
        } else {
            $flash = ['type' => 'danger', 'msg' => "❌ " . implode(' ', $errors)];
        }
    }

    // ── DELETE ─────────────────────────────────────────────
    elseif ($action === 'delete') {
        $id   = (int)($_POST['id'] ?? 0);
        $nama = '';
        foreach ($data as $row) { if ($row['id'] === $id) { $nama = $row['nama']; break; } }
        $data = array_filter($data, fn($r) => $r['id'] !== $id);
        saveData($data);
        $flash = ['type' => 'warning', 'msg' => "🗑️ Data <strong>" . sanitize($nama) . "</strong> telah dihapus."];
    }

    // Redirect agar tidak re-submit saat refresh (PRG pattern)
    $flashJson = urlencode(json_encode($flash));
    header("Location: " . $_SERVER['PHP_SELF'] . "?flash=$flashJson");
    exit;
}

// ── Ambil flash message dari query string ──────────────────
if (isset($_GET['flash'])) {
    $flash = json_decode(urldecode($_GET['flash']), true);
}

// ── Load & proses data untuk ditampilkan ───────────────────
$rawData        = loadData();
$hasilMahasiswa = [];
$totalNilai     = 0;
$nilaiTertinggi = 0;
$namaTertinggi  = '';

foreach ($rawData as $mhs) {
    $na     = hitungNilaiAkhir($mhs['nilai_tugas'], $mhs['nilai_uts'], $mhs['nilai_uas']);
    $grade  = tentukanGrade($na);
    $status = tentukanStatus($na);
    $totalNilai += $na;
    if ($na > $nilaiTertinggi) { $nilaiTertinggi = $na; $namaTertinggi = $mhs['nama']; }
    $hasilMahasiswa[] = array_merge($mhs, [
        'nilai_akhir' => $na,
        'grade'       => $grade,
        'status'      => $status,
    ]);
}

$jumlahMahasiswa = count($hasilMahasiswa);
$rataRata        = $jumlahMahasiswa ? round($totalNilai / $jumlahMahasiswa, 2) : 0;
$gradeRataRata   = $jumlahMahasiswa ? tentukanGrade($rataRata) : '-';
$jumlahLulus     = count(array_filter($hasilMahasiswa, fn($m) => $m['status'] === 'Lulus'));

?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistem Nilai Mahasiswa 🌸</title>

<!-- CDN -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<style>
/* ══════════════════════════════════════════════════
   CSS VARIABLES — LIGHT (SUMMER)
══════════════════════════════════════════════════ */
:root {
    --bg-from:#FFE45E; --bg-mid:#FF9A3C; --bg-to:#FF6B9D;
    --card-bg:#fffdf7;
    --card-shadow:0 24px 64px rgba(255,107,107,.18);
    --text-primary:#1a1a2e;
    --text-secondary:#6b6b8a;
    --table-stripe:#fff8f0;
    --table-hover:#fff0e3;
    --border-color:#ffe0b2;
    --header-bg:linear-gradient(90deg,#ff9a3c,#ff6b9d);
    --header-text:#fff;
    --stat-bg:rgba(255,255,255,.72);
    --stat-border:rgba(255,154,60,.28);
    --input-bg:#fff;
    --input-border:#ffc58a;
    --input-focus:#ff9a3c;
    --modal-bg:#fff;
    --modal-overlay:rgba(0,0,0,.45);
    --g-a-bg:#d4edda;--g-a-tx:#155724;
    --g-b-bg:#cce5ff;--g-b-tx:#004085;
    --g-c-bg:#fff3cd;--g-c-tx:#856404;
    --g-d-bg:#ffe5cc;--g-d-tx:#a04000;
    --g-e-bg:#f8d7da;--g-e-tx:#721c24;
    --s-l-bg:#d4edda; --s-l-tx:#155724;
    --s-tl-bg:#f8d7da;--s-tl-tx:#721c24;
    --btn-add-bg:linear-gradient(135deg,#ff9a3c,#ff6b9d);
    --btn-add-shadow:rgba(255,107,157,.35);
}
/* ══════════════════════════════════════════════════
   CSS VARIABLES — DARK
══════════════════════════════════════════════════ */
body.dark {
    --bg-from:#180800;--bg-mid:#2b1200;--bg-to:#2b001a;
    --card-bg:#1e1b2e;
    --card-shadow:0 24px 64px rgba(0,0,0,.55);
    --text-primary:#f0e6d3;
    --text-secondary:#9e8e7e;
    --table-stripe:#252238;
    --table-hover:#2e294a;
    --border-color:#3d2e1e;
    --header-bg:linear-gradient(90deg,#b05a1a,#8c1f55);
    --header-text:#ffe0c0;
    --stat-bg:rgba(30,27,46,.88);
    --stat-border:rgba(200,100,50,.22);
    --input-bg:#252238;
    --input-border:#5a3a1a;
    --input-focus:#ff9a3c;
    --modal-bg:#1e1b2e;
    --modal-overlay:rgba(0,0,0,.7);
    --g-a-bg:#0f3320;--g-a-tx:#6fcf97;
    --g-b-bg:#0a1f3c;--g-b-tx:#56aeff;
    --g-c-bg:#2e2200;--g-c-tx:#f2c94c;
    --g-d-bg:#2d1200;--g-d-tx:#f2994a;
    --g-e-bg:#2d0010;--g-e-tx:#eb5757;
    --s-l-bg:#0f3320; --s-l-tx:#6fcf97;
    --s-tl-bg:#2d0010;--s-tl-tx:#eb5757;
    --btn-add-bg:linear-gradient(135deg,#b05a1a,#8c1f55);
    --btn-add-shadow:rgba(140,31,85,.4);
}

/* ══════════════════════════════════════════════════
   BASE
══════════════════════════════════════════════════ */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{
    font-family:'DM Sans',sans-serif;
    background:linear-gradient(135deg,var(--bg-from) 0%,var(--bg-mid) 45%,var(--bg-to) 100%);
    background-attachment:fixed;
    min-height:100vh;
    color:var(--text-primary);
    transition:background .45s,color .3s;
}

/* Background blobs */
.bg-blob{position:fixed;border-radius:50%;pointer-events:none;z-index:0;opacity:.14}
.bg-blob-1{width:520px;height:520px;background:radial-gradient(circle,#ffe066,transparent);top:-180px;left:-180px;animation:blobFloat 9s ease-in-out infinite}
.bg-blob-2{width:420px;height:420px;background:radial-gradient(circle,#ff6b9d,transparent);bottom:-120px;right:-120px;animation:blobFloat 11s ease-in-out infinite reverse}
@keyframes blobFloat{0%,100%{transform:translateY(0) scale(1)}50%{transform:translateY(-28px) scale(1.06)}}

/* ══════════════════════════════════════════════════
   LAYOUT
══════════════════════════════════════════════════ */
.wrap{position:relative;z-index:1;max-width:1140px;margin:0 auto;padding:2.5rem 1.25rem 4rem}

/* ══════════════════════════════════════════════════
   HERO
══════════════════════════════════════════════════ */
.hero{text-align:center;margin-bottom:2rem;animation:slideDown .65s cubic-bezier(.34,1.56,.64,1) both}
@keyframes slideDown{from{opacity:0;transform:translateY(-44px)}to{opacity:1;transform:translateY(0)}}
.hero-emoji{font-size:3.8rem;display:block;margin-bottom:.3rem;animation:bounceEmoji 2.2s ease-in-out infinite}
@keyframes bounceEmoji{0%,100%{transform:translateY(0) rotate(-3deg)}50%{transform:translateY(-12px) rotate(3deg)}}
.hero h1{font-family:'Playfair Display',serif;font-size:clamp(1.9rem,4.5vw,3rem);font-weight:900;color:#fff;text-shadow:0 4px 24px rgba(0,0,0,.2);line-height:1.18}
.hero p{color:rgba(255,255,255,.82);font-size:.95rem;margin-top:.45rem;font-weight:300}

/* ══════════════════════════════════════════════════
   CONTROLS BAR
══════════════════════════════════════════════════ */
.controls-bar{display:flex;justify-content:space-between;align-items:center;gap:.75rem;margin-bottom:1.4rem;flex-wrap:wrap;animation:fadeIn .5s .2s both}
.controls-right{display:flex;align-items:center;gap:.75rem;flex-wrap:wrap}
@keyframes fadeIn{from{opacity:0}to{opacity:1}}

/* Toggle */
.toggle-wrap{display:flex;align-items:center;gap:.45rem}
.toggle-label{font-size:.82rem;color:rgba(255,255,255,.88);font-weight:500;min-width:32px}
.toggle-switch{position:relative;width:50px;height:27px;background:rgba(255,255,255,.35);border-radius:14px;cursor:pointer;border:1.5px solid rgba(255,255,255,.5);outline:none;transition:background .3s;flex-shrink:0}
.toggle-switch::after{content:'';position:absolute;width:21px;height:21px;background:#fff;border-radius:50%;top:2px;left:2px;transition:transform .3s cubic-bezier(.34,1.56,.64,1),background .3s;box-shadow:0 2px 6px rgba(0,0,0,.2)}
.toggle-switch.on{background:rgba(255,107,157,.6)}
.toggle-switch.on::after{transform:translateX(23px);background:#1e1b2e}

/* Buttons */
.btn-glass{background:rgba(255,255,255,.2);color:#fff;border:1.5px solid rgba(255,255,255,.45);border-radius:12px;padding:.45rem 1.15rem;font-family:'DM Sans',sans-serif;font-size:.87rem;font-weight:600;backdrop-filter:blur(8px);cursor:pointer;transition:background .22s,transform .18s,box-shadow .2s;display:inline-flex;align-items:center;gap:.4rem}
.btn-glass:hover{background:rgba(255,255,255,.36);transform:translateY(-2px);box-shadow:0 8px 20px rgba(0,0,0,.15)}
.btn-glass:active{transform:translateY(0)}

.btn-add{background:linear-gradient(135deg,#fff 0%,#fff5e0 100%);color:#d4600a;border:none;border-radius:12px;padding:.48rem 1.2rem;font-family:'DM Sans',sans-serif;font-size:.9rem;font-weight:700;cursor:pointer;transition:transform .18s,box-shadow .2s;display:inline-flex;align-items:center;gap:.4rem;box-shadow:0 4px 16px rgba(255,107,57,.25)}
.btn-add:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(255,107,57,.35)}
.btn-add:active{transform:translateY(0)}

/* ══════════════════════════════════════════════════
   FLASH NOTIFICATION
══════════════════════════════════════════════════ */
.flash{border-radius:14px;padding:.85rem 1.2rem;margin-bottom:1.4rem;font-size:.9rem;font-weight:500;border:none;animation:flashSlide .4s cubic-bezier(.34,1.56,.64,1)}
@keyframes flashSlide{from{opacity:0;transform:translateY(-16px)}to{opacity:1;transform:translateY(0)}}
.flash-success{background:#d4edda;color:#155724}
.flash-danger {background:#f8d7da;color:#721c24}
.flash-warning{background:#fff3cd;color:#856404}

/* ══════════════════════════════════════════════════
   STATS ROW
══════════════════════════════════════════════════ */
.stats-row{display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:1rem;margin-bottom:1.6rem;animation:fadeUp .55s .15s both}
@keyframes fadeUp{from{opacity:0;transform:translateY(22px)}to{opacity:1;transform:translateY(0)}}
.stat-card{background:var(--stat-bg);border:1.5px solid var(--stat-border);border-radius:20px;padding:1.3rem 1.4rem;backdrop-filter:blur(12px);text-align:center;transition:transform .25s,box-shadow .25s}
.stat-card:hover{transform:translateY(-5px);box-shadow:0 14px 36px rgba(255,100,100,.18)}
.stat-icon{font-size:1.9rem;display:block;margin-bottom:.3rem}
.stat-value{font-family:'Playfair Display',serif;font-size:2rem;font-weight:700;color:var(--text-primary);line-height:1}
.stat-label{font-size:.76rem;color:var(--text-secondary);text-transform:uppercase;letter-spacing:.07em;margin-top:.22rem}
.stat-sub{font-size:.8rem;color:var(--text-secondary);margin-top:.2rem}

/* ══════════════════════════════════════════════════
   MAIN CARD & TABLE
══════════════════════════════════════════════════ */
.main-card{background:var(--card-bg);border-radius:24px;box-shadow:var(--card-shadow);overflow:hidden;animation:fadeUp .65s .3s both;transition:background .35s,box-shadow .35s}
.card-head{background:var(--header-bg);padding:1.15rem 1.6rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.5rem}
.card-head h2{font-family:'Playfair Display',serif;font-size:1.25rem;font-weight:700;color:var(--header-text);margin:0}
.card-head-pill{font-size:.8rem;color:rgba(255,255,255,.82);background:rgba(255,255,255,.2);padding:.22rem .75rem;border-radius:20px}

/* Search bar */
.search-wrap{padding:.9rem 1.4rem;border-bottom:1px solid var(--border-color);display:flex;gap:.5rem;align-items:center}
.search-input{flex:1;border:1.5px solid var(--input-border);border-radius:10px;padding:.45rem .9rem;font-size:.88rem;font-family:'DM Sans',sans-serif;background:var(--input-bg);color:var(--text-primary);outline:none;transition:border-color .2s,box-shadow .2s}
.search-input:focus{border-color:var(--input-focus);box-shadow:0 0 0 3px rgba(255,154,60,.18)}

.tbl-wrap{overflow-x:auto}
table.tbl{width:100%;border-collapse:collapse;font-size:.9rem}
table.tbl thead tr{background:var(--header-bg)}
table.tbl thead th{color:var(--header-text);padding:.85rem 1rem;font-weight:600;font-size:.75rem;text-transform:uppercase;letter-spacing:.07em;border:none;white-space:nowrap}
table.tbl tbody tr{border-bottom:1px solid var(--border-color);transition:background .18s,transform .18s,box-shadow .18s}
table.tbl tbody tr:nth-child(even){background:var(--table-stripe)}
table.tbl tbody tr:hover{background:var(--table-hover)!important;transform:scale(1.002);box-shadow:0 4px 14px rgba(255,107,107,.1)}
table.tbl td{padding:.82rem 1rem;color:var(--text-primary);vertical-align:middle;border:none}
.td-no{width:40px;color:var(--text-secondary);font-weight:600}
.td-name{font-weight:600}
.td-nim{font-size:.8rem;color:var(--text-secondary);font-family:monospace;letter-spacing:.04em}
.td-score{font-family:'Playfair Display',serif;font-size:1.05rem;font-weight:700}

/* Component pills */
.cpills{display:flex;gap:.3rem;flex-wrap:wrap}
.cpill{font-size:.72rem;background:rgba(255,154,60,.1);color:var(--text-secondary);border:1px solid rgba(255,154,60,.22);border-radius:7px;padding:.12rem .42rem}
body.dark .cpill{background:rgba(255,154,60,.07)}

/* CRUD action buttons in table */
.btn-tbl{border:none;border-radius:8px;padding:.28rem .6rem;font-size:.75rem;font-weight:600;cursor:pointer;transition:transform .15s,box-shadow .15s;display:inline-flex;align-items:center;gap:.25rem}
.btn-tbl:hover{transform:translateY(-1px);box-shadow:0 4px 10px rgba(0,0,0,.15)}
.btn-edit{background:#cce5ff;color:#004085}
body.dark .btn-edit{background:#0a1f3c;color:#56aeff}
.btn-del{background:#f8d7da;color:#721c24}
body.dark .btn-del{background:#2d0010;color:#eb5757}

/* Badges */
.badge{display:inline-block;padding:.26rem .7rem;border-radius:20px;font-size:.78rem;font-weight:600;letter-spacing:.04em}
.gA{background:var(--g-a-bg);color:var(--g-a-tx)}
.gB{background:var(--g-b-bg);color:var(--g-b-tx)}
.gC{background:var(--g-c-bg);color:var(--g-c-tx)}
.gD{background:var(--g-d-bg);color:var(--g-d-tx)}
.gE{background:var(--g-e-bg);color:var(--g-e-tx)}
.sL {background:var(--s-l-bg); color:var(--s-l-tx)}
.sTL{background:var(--s-tl-bg);color:var(--s-tl-tx)}

/* Empty state */
.empty-state{text-align:center;padding:3rem 1rem;color:var(--text-secondary)}
.empty-state .empty-icon{font-size:3rem;display:block;margin-bottom:.6rem}

/* ══════════════════════════════════════════════════
   MODAL (CUSTOM — no Bootstrap modal, for clarity)
══════════════════════════════════════════════════ */
.modal-overlay{position:fixed;inset:0;background:var(--modal-overlay);z-index:1000;display:flex;align-items:center;justify-content:center;padding:1rem;opacity:0;pointer-events:none;transition:opacity .25s}
.modal-overlay.open{opacity:1;pointer-events:all}
.modal-box{background:var(--modal-bg);border-radius:22px;width:100%;max-width:520px;box-shadow:0 32px 80px rgba(0,0,0,.25);transform:scale(.93) translateY(20px);transition:transform .3s cubic-bezier(.34,1.56,.64,1),opacity .25s;overflow:hidden}
.modal-overlay.open .modal-box{transform:scale(1) translateY(0)}
.modal-header{background:var(--header-bg);padding:1.1rem 1.5rem;display:flex;align-items:center;justify-content:space-between}
.modal-header h3{font-family:'Playfair Display',serif;font-size:1.15rem;font-weight:700;color:var(--header-text);margin:0}
.modal-close{background:rgba(255,255,255,.2);border:none;border-radius:8px;width:32px;height:32px;color:#fff;font-size:1.1rem;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .2s}
.modal-close:hover{background:rgba(255,255,255,.35)}
.modal-body{padding:1.5rem}

/* Form inputs */
.form-group{margin-bottom:1.1rem}
.form-label{display:block;font-size:.82rem;font-weight:600;color:var(--text-secondary);margin-bottom:.35rem;text-transform:uppercase;letter-spacing:.05em}
.form-control{width:100%;border:1.5px solid var(--input-border);border-radius:10px;padding:.5rem .9rem;font-size:.92rem;font-family:'DM Sans',sans-serif;background:var(--input-bg);color:var(--text-primary);outline:none;transition:border-color .2s,box-shadow .2s}
.form-control:focus{border-color:var(--input-focus);box-shadow:0 0 0 3px rgba(255,154,60,.18)}
.form-row{display:grid;grid-template-columns:1fr 1fr 1fr;gap:.75rem}
@media(max-width:480px){.form-row{grid-template-columns:1fr}}
.modal-footer{padding:1rem 1.5rem 1.5rem;display:flex;justify-content:flex-end;gap:.6rem}

.btn-submit{background:var(--btn-add-bg);color:#fff;border:none;border-radius:12px;padding:.55rem 1.4rem;font-family:'DM Sans',sans-serif;font-size:.9rem;font-weight:700;cursor:pointer;transition:transform .18s,box-shadow .2s;box-shadow:0 4px 14px var(--btn-add-shadow)}
.btn-submit:hover{transform:translateY(-2px);box-shadow:0 8px 22px var(--btn-add-shadow)}
.btn-cancel{background:transparent;color:var(--text-secondary);border:1.5px solid var(--border-color);border-radius:12px;padding:.55rem 1.1rem;font-family:'DM Sans',sans-serif;font-size:.9rem;cursor:pointer;transition:background .2s}
.btn-cancel:hover{background:var(--table-stripe)}

/* ── Delete Confirm Modal ── */
.del-modal-box{max-width:400px;text-align:center}
.del-icon{font-size:3rem;margin-bottom:.6rem;display:block}
.del-modal-box p{color:var(--text-secondary);font-size:.92rem;margin-bottom:1rem}
.del-modal-box strong{color:var(--text-primary)}
.btn-confirm-del{background:#f8d7da;color:#721c24;border:none;border-radius:12px;padding:.55rem 1.4rem;font-family:'DM Sans',sans-serif;font-size:.9rem;font-weight:700;cursor:pointer;transition:background .2s,transform .18s}
.btn-confirm-del:hover{background:#f5c6cb;transform:translateY(-1px)}

/* ══════════════════════════════════════════════════
   FOOTER & MISC
══════════════════════════════════════════════════ */
.page-footer{text-align:center;margin-top:2.5rem;color:rgba(255,255,255,.68);font-size:.8rem}
@media(max-width:600px){
    .hero h1{font-size:1.7rem}
    table.tbl thead th,table.tbl td{padding:.6rem .5rem;font-size:.78rem}
    .cpills{display:none}
    .btn-tbl span{display:none}
}
@media print{body{background:#fff!important}.controls-bar,.modal-overlay{display:none!important}}
</style>
</head>
<body>

<div class="bg-blob bg-blob-1"></div>
<div class="bg-blob bg-blob-2"></div>

<!-- ════════════════════════════════════════════════════════
     MODAL: TAMBAH / EDIT MAHASISWA
════════════════════════════════════════════════════════ -->
<div class="modal-overlay" id="modalForm">
    <div class="modal-box">
        <div class="modal-header">
            <h3 id="modalTitle">➕ Tambah Mahasiswa</h3>
            <button class="modal-close" onclick="closeModal('modalForm')">✕</button>
        </div>
        <form method="POST" id="crudForm">
            <input type="hidden" name="action" id="formAction" value="create">
            <input type="hidden" name="id"     id="formId"     value="">
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input class="form-control" type="text" name="nama" id="formNama" placeholder="Contoh: Andi Pratama" required>
                </div>
                <div class="form-group">
                    <label class="form-label">NIM</label>
                    <input class="form-control" type="text" name="nim" id="formNim" placeholder="Contoh: 2021001006" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nilai Tugas</label>
                        <input class="form-control" type="number" name="nilai_tugas" id="formTugas" min="0" max="100" placeholder="0–100" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nilai UTS</label>
                        <input class="form-control" type="number" name="nilai_uts" id="formUts" min="0" max="100" placeholder="0–100" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nilai UAS</label>
                        <input class="form-control" type="number" name="nilai_uas" id="formUas" min="0" max="100" placeholder="0–100" required>
                    </div>
                </div>
                <!-- Live preview nilai akhir -->
                <div style="background:var(--table-stripe);border-radius:12px;padding:.75rem 1rem;font-size:.88rem;color:var(--text-secondary)">
                    Nilai Akhir (preview): &nbsp;
                    <strong id="previewNilai" style="font-family:'Playfair Display',serif;font-size:1.1rem;color:var(--text-primary)">—</strong>
                    &nbsp;<span id="previewGrade" class="badge" style="font-size:.75rem"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal('modalForm')">Batal</button>
                <button type="submit" class="btn-submit" id="submitBtn">💾 Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- ════════════════════════════════════════════════════════
     MODAL: KONFIRMASI HAPUS
════════════════════════════════════════════════════════ -->
<div class="modal-overlay" id="modalDelete">
    <div class="modal-box del-modal-box">
        <div class="modal-header">
            <h3>Konfirmasi Hapus</h3>
            <button class="modal-close" onclick="closeModal('modalDelete')">✕</button>
        </div>
        <form method="POST" id="deleteForm">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" id="deleteId">
            <div class="modal-body" style="text-align:center">
                <span class="del-icon">🗑️</span>
                <p>Apakah kamu yakin ingin menghapus data mahasiswa:<br><strong id="deleteName"></strong>?<br><br>Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer" style="justify-content:center;gap:.8rem">
                <button type="button" class="btn-cancel" onclick="closeModal('modalDelete')">Batal</button>
                <button type="submit" class="btn-confirm-del">🗑️ Ya, Hapus</button>
            </div>
        </form>
    </div>
</div>

<!-- ════════════════════════════════════════════════════════
     MAIN CONTENT
════════════════════════════════════════════════════════ -->
<div class="wrap" id="exportArea">

    <!-- Hero -->
    <div class="hero">
        <span class="hero-emoji">🌸</span>
        <h1>Sistem Penilaian Mahasiswa</h1>
        <p>Rekap nilai &amp; kelulusan &bull; Semester Genap 2024/2025</p>
    </div>

    <!-- Flash Message -->
    <?php if ($flash): ?>
    <div class="flash flash-<?= $flash['type'] ?>" id="flashMsg">
        <?= $flash['msg'] ?>
    </div>
    <?php endif; ?>

    <!-- Controls Bar -->
    <div class="controls-bar" id="ctrlBar">
        <!-- Tombol Tambah -->
        <button class="btn-add" onclick="openAddModal()">
            ➕ <span>Tambah Mahasiswa</span>
        </button>
        <!-- Kanan: toggle + export -->
        <div class="controls-right">
            <div class="toggle-wrap">
                <span style="font-size:1rem">☀️</span>
                <button class="toggle-switch" id="darkToggle" aria-label="Toggle dark mode"></button>
                <span style="font-size:1rem">🌙</span>
                <span class="toggle-label" id="toggleLabel">Light</span>
            </div>
            <button class="btn-glass" id="btnExport">📄 Export PDF</button>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-row" id="statsRow">
        <div class="stat-card">
            <span class="stat-icon">👥</span>
            <div class="stat-value"><?= $jumlahMahasiswa ?></div>
            <div class="stat-label">Total Mahasiswa</div>
        </div>
        <div class="stat-card">
            <span class="stat-icon">📊</span>
            <div class="stat-value"><?= $rataRata ?></div>
            <div class="stat-label">Rata-rata Kelas</div>
            <div class="stat-sub">Grade <?= $gradeRataRata ?></div>
        </div>
        <div class="stat-card">
            <span class="stat-icon">🏆</span>
            <div class="stat-value"><?= $nilaiTertinggi ?></div>
            <div class="stat-label">Nilai Tertinggi</div>
            <div class="stat-sub"><?= htmlspecialchars($namaTertinggi ?: '-') ?></div>
        </div>
        <div class="stat-card">
            <span class="stat-icon">✅</span>
            <div class="stat-value"><?= $jumlahLulus ?>/<?= $jumlahMahasiswa ?></div>
            <div class="stat-label">Mahasiswa Lulus</div>
            <div class="stat-sub"><?= $jumlahMahasiswa - $jumlahLulus ?> tidak lulus</div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="main-card">
        <div class="card-head">
            <h2>📋 Daftar Nilai Mahasiswa</h2>
            <span class="card-head-pill" id="tableCount"><?= $jumlahMahasiswa ?> mahasiswa</span>
        </div>
        <!-- Search bar (client-side filter) -->
        <div class="search-wrap">
            <span style="font-size:1.1rem">🔍</span>
            <input class="search-input" type="text" id="searchInput" placeholder="Cari nama atau NIM...">
        </div>
        <div class="tbl-wrap">
            <table class="tbl" id="mainTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Komponen Nilai</th>
                        <th>Nilai Akhir</th>
                        <th>Grade</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                <?php if (empty($hasilMahasiswa)): ?>
                    <tr><td colspan="8">
                        <div class="empty-state">
                            <span class="empty-icon">📭</span>
                            Belum ada data mahasiswa. Klik <strong>Tambah Mahasiswa</strong> untuk memulai.
                        </div>
                    </td></tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($hasilMahasiswa as $row):
                        $gc = 'g' . $row['grade'];
                        $sc = $row['status'] === 'Lulus' ? 'sL' : 'sTL';
                        $si = $row['status'] === 'Lulus' ? '✓' : '✗';
                    ?>
                    <tr data-search="<?= strtolower(htmlspecialchars($row['nama'])) ?> <?= strtolower(htmlspecialchars($row['nim'])) ?>">
                        <td class="td-no"><?= $no++ ?></td>
                        <td class="td-name"><?= htmlspecialchars($row['nama']) ?></td>
                        <td class="td-nim"><?= htmlspecialchars($row['nim']) ?></td>
                        <td>
                            <div class="cpills">
                                <span class="cpill">T: <?= $row['nilai_tugas'] ?></span>
                                <span class="cpill">UTS: <?= $row['nilai_uts'] ?></span>
                                <span class="cpill">UAS: <?= $row['nilai_uas'] ?></span>
                            </div>
                        </td>
                        <td class="td-score"><?= $row['nilai_akhir'] ?></td>
                        <td><span class="badge <?= $gc ?>"><?= $row['grade'] ?></span></td>
                        <td><span class="badge <?= $sc ?>"><?= $si ?> <?= $row['status'] ?></span></td>
                        <td>
                            <div style="display:flex;gap:.4rem;flex-wrap:wrap">
                                <button class="btn-tbl btn-edit"
                                    onclick="openEditModal(
                                        <?= $row['id'] ?>,
                                        '<?= addslashes($row['nama']) ?>',
                                        '<?= addslashes($row['nim']) ?>',
                                        <?= $row['nilai_tugas'] ?>,
                                        <?= $row['nilai_uts'] ?>,
                                        <?= $row['nilai_uas'] ?>
                                    )">
                                    ✏️ <span>Edit</span>
                                </button>
                                <button class="btn-tbl btn-del"
                                    onclick="openDeleteModal(<?= $row['id'] ?>, '<?= addslashes($row['nama']) ?>')">
                                    🗑️ <span>Hapus</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="page-footer">
        <p>🌺 Sistem Informasi Akademik &bull; Dibuat dengan PHP &bull; <?= date('Y') ?></p>
    </div>
</div>

<!-- ════════════════════════════════════════════════════════
     JAVASCRIPT
════════════════════════════════════════════════════════ -->
<script>
// ── Dark Mode ──────────────────────────────────────────────
const body        = document.body;
const darkToggle  = document.getElementById('darkToggle');
const toggleLabel = document.getElementById('toggleLabel');

function applyDark(on) {
    body.classList.toggle('dark', on);
    darkToggle.classList.toggle('on', on);
    toggleLabel.textContent = on ? 'Dark' : 'Light';
}
// Terapkan preferensi tersimpan
applyDark(localStorage.getItem('darkMode') === 'true');
darkToggle.addEventListener('click', () => {
    const isDark = !body.classList.contains('dark');
    applyDark(isDark);
    localStorage.setItem('darkMode', isDark);
});

// ── Flash Auto-dismiss ──────────────────────────────────────
const flashMsg = document.getElementById('flashMsg');
if (flashMsg) {
    setTimeout(() => {
        flashMsg.style.transition = 'opacity .5s';
        flashMsg.style.opacity = '0';
        setTimeout(() => flashMsg.remove(), 500);
    }, 4000);
}

// ── Modal Helpers ──────────────────────────────────────────
function openModal(id)  { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }

// Tutup modal saat klik overlay
document.querySelectorAll('.modal-overlay').forEach(el => {
    el.addEventListener('click', e => {
        if (e.target === el) closeModal(el.id);
    });
});
// Tutup modal dengan Escape
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        closeModal('modalForm');
        closeModal('modalDelete');
    }
});

// ── Modal Tambah ───────────────────────────────────────────
function openAddModal() {
    document.getElementById('modalTitle').textContent = '➕ Tambah Mahasiswa';
    document.getElementById('formAction').value = 'create';
    document.getElementById('formId').value     = '';
    document.getElementById('submitBtn').textContent = '💾 Simpan';
    // Reset form
    ['formNama','formNim','formTugas','formUts','formUas'].forEach(id => {
        document.getElementById(id).value = '';
    });
    updatePreview();
    openModal('modalForm');
    setTimeout(() => document.getElementById('formNama').focus(), 200);
}

// ── Modal Edit ─────────────────────────────────────────────
function openEditModal(id, nama, nim, tugas, uts, uas) {
    document.getElementById('modalTitle').textContent = '✏️ Edit Mahasiswa';
    document.getElementById('formAction').value = 'update';
    document.getElementById('formId').value     = id;
    document.getElementById('formNama').value   = nama;
    document.getElementById('formNim').value    = nim;
    document.getElementById('formTugas').value  = tugas;
    document.getElementById('formUts').value    = uts;
    document.getElementById('formUas').value    = uas;
    document.getElementById('submitBtn').textContent = '💾 Update';
    updatePreview();
    openModal('modalForm');
    setTimeout(() => document.getElementById('formNama').focus(), 200);
}

// ── Modal Hapus ────────────────────────────────────────────
function openDeleteModal(id, nama) {
    document.getElementById('deleteId').value  = id;
    document.getElementById('deleteName').textContent = nama;
    openModal('modalDelete');
}

// ── Live Preview Nilai Akhir ───────────────────────────────
function updatePreview() {
    const t  = parseFloat(document.getElementById('formTugas').value) || 0;
    const u  = parseFloat(document.getElementById('formUts').value)   || 0;
    const a  = parseFloat(document.getElementById('formUas').value)   || 0;

    if (document.getElementById('formTugas').value === '' &&
        document.getElementById('formUts').value   === '' &&
        document.getElementById('formUas').value   === '') {
        document.getElementById('previewNilai').textContent = '—';
        document.getElementById('previewGrade').textContent = '';
        document.getElementById('previewGrade').className   = 'badge';
        return;
    }

    const na    = Math.round(((t * 0.3) + (u * 0.3) + (a * 0.4)) * 100) / 100;
    const grade = na >= 85 ? 'A' : na >= 70 ? 'B' : na >= 60 ? 'C' : na >= 50 ? 'D' : 'E';
    const gcMap = {A:'gA',B:'gB',C:'gC',D:'gD',E:'gE'};

    document.getElementById('previewNilai').textContent = na;
    const pg = document.getElementById('previewGrade');
    pg.textContent = grade;
    pg.className   = 'badge ' + gcMap[grade];
}

['formTugas','formUts','formUas'].forEach(id => {
    document.getElementById(id).addEventListener('input', updatePreview);
});

// ── Client-side Search / Filter ────────────────────────────
const searchInput = document.getElementById('searchInput');
const tableCount  = document.getElementById('tableCount');

searchInput.addEventListener('input', () => {
    const q     = searchInput.value.toLowerCase().trim();
    const rows  = document.querySelectorAll('#tableBody tr[data-search]');
    let visible = 0;

    rows.forEach(row => {
        const match = !q || row.dataset.search.includes(q);
        row.style.display = match ? '' : 'none';
        if (match) visible++;
    });

    tableCount.textContent = q
        ? `${visible} dari <?= $jumlahMahasiswa ?> mahasiswa`
        : `<?= $jumlahMahasiswa ?> mahasiswa`;
});

// ── Export PDF ─────────────────────────────────────────────
document.getElementById('btnExport').addEventListener('click', () => {
    const area    = document.getElementById('exportArea');
    const ctrlBar = document.getElementById('ctrlBar');
    const search  = document.querySelector('.search-wrap');
    const actCols = document.querySelectorAll('.tbl thead th:last-child, .tbl tbody td:last-child');

    // Sembunyikan elemen non-printable
    ctrlBar.style.display = 'none';
    search.style.display  = 'none';
    actCols.forEach(el => el.style.display = 'none');

    html2pdf().set({
        margin:      [8,8,8,8],
        filename:    'nilai-mahasiswa.pdf',
        image:       { type:'jpeg', quality:.97 },
        html2canvas: { scale:2, useCORS:true, logging:false },
        jsPDF:       { unit:'mm', format:'a4', orientation:'landscape' }
    }).from(area).save().then(() => {
        ctrlBar.style.display = '';
        search.style.display  = '';
        actCols.forEach(el => el.style.display = '');
    });
});
</script>
</body>
</html>