<?php
/* =========================================================
   data.php - sumber data tunggal PeduliPalestina
   Dipakai oleh index.php (tampilan) dan api/programs.php (API)
   ========================================================= */

/* ----- Variable (Week 5 Task 01) ----- */
$lembaga = [
    'nama'    => 'PeduliPalestina',
    'periode' => '2026 - 2027',
];
$jumlah_donatur   = 4520;
$penerima_manfaat = 12500;

/* ----- Array data program (Week 5 Task 02 & 03) ----- */
$programs = [
    [
        'id'          => 'medis',
        'title'       => 'Bantuan Medis & Ambulans Darurat',
        'description' => 'Penyediaan obat-obatan esensial, kasa steril, dan operasional tim medis darurat di lapangan.',
        'target'      => 500000000,
        'terkumpul'   => 320000000,
        'category'    => 'Kesehatan',
    ],
    [
        'id'          => 'pangan',
        'title'       => 'Dapur Umum & Paket Pangan',
        'description' => 'Distribusi ribuan porsi makanan hangat dan bahan pokok gandum untuk keluarga di pengungsian.',
        'target'      => 400000000,
        'terkumpul'   => 280000000,
        'category'    => 'Pangan',
    ],
    [
        'id'          => 'air',
        'title'       => 'Truk Air Bersih & Sanitasi',
        'description' => 'Pasokan air layak minum dan penyediaan fasilitas sanitasi darurat untuk mencegah penyakit.',
        'target'      => 300000000,
        'terkumpul'   => 250000000,
        'category'    => 'Air & Sanitasi',
    ],
];

$agenda = [
    [
        'tanggal' => '2026-09-25',
        'judul'   => 'Distribusi 500 Tangki Air Bersih',
        'isi'     => 'Penyaluran air bersih untuk kamp-kamp pengungsian wilayah Khan Younis dan Deir al-Balah.',
        'gambar'  => 'air',
        'alt'     => 'Distribusi air bersih',
    ],
    [
        'tanggal' => '2026-09-20',
        'judul'   => 'Pengiriman Paket Medis ke RS Lapangan',
        'isi'     => 'Peralatan bedah darurat dan infus telah diterima oleh dokter sukarelawan setempat.',
        'gambar'  => 'medis',
        'alt'     => 'Pengiriman paket medis',
    ],
];

/* ----- Fungsi bantu ----- */
function e($teks)
{
    return htmlspecialchars((string) $teks, ENT_QUOTES, 'UTF-8');
}

function rupiah($angka)
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

function hitung_persen($program)
{
    if ($program['target'] <= 0) {
        return 0;
    }
    return min(100, (int) round($program['terkumpul'] / $program['target'] * 100));
}

/* Conditional: tentukan status berdasarkan persentase */
function status_program($persen)
{
    if ($persen >= 100) {
        return ['Tercapai', 'tercapai'];
    } elseif ($persen >= 80) {
        return ['Hampir Tercapai', 'hampir'];
    } elseif ($persen >= 60) {
        return ['Berjalan', 'berjalan'];
    }
    return ['Butuh Dukungan', 'mendesak'];
}

function tanggal_indonesia($tanggal)
{
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
    ];
    $waktu = strtotime($tanggal);
    return date('j', $waktu) . ' ' . $bulan[(int) date('n', $waktu)] . ' ' . date('Y', $waktu);
}

/* ----- Pemrosesan data ----- */
$total_terkumpul = array_sum(array_column($programs, 'terkumpul'));
$total_target    = array_sum(array_column($programs, 'target'));
$persen_total    = $total_target > 0 ? (int) round($total_terkumpul / $total_target * 100) : 0;
list($status_label, $status_kelas) = status_program($persen_total);

$statistik = [
    ['angka' => rupiah($total_terkumpul),                                   'label' => 'Total Dana Terhimpun'],
    ['angka' => number_format($jumlah_donatur, 0, ',', '.') . ' Orang',     'label' => 'Jumlah Donatur Tergabung'],
    ['angka' => number_format($penerima_manfaat, 0, ',', '.') . ' Warga',   'label' => 'Penerima Manfaat Bantuan'],
];

/* Data per-id untuk panel detail di JavaScript */
$programs_by_id = [];
foreach ($programs as $p) {
    $programs_by_id[$p['id']] = $p;
}
