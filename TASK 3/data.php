<?php
/* =========================================================
   data.php - sumber data tunggal PeduliPalestina
   Dipakai oleh index.php (tampilan) dan api/programs.php (API)
   ========================================================= */

require_once __DIR__ . '/Lembaga.php';

/* ----- Object Lembaga berisi object Program (Week 6: OOP) ----- */
$lembaga = new Lembaga('PeduliPalestina', '2026 - 2027', 4520, 12500, [
    new Program('medis', 'Bantuan Medis & Ambulans Darurat',
        'Penyediaan obat-obatan esensial, kasa steril, dan operasional tim medis darurat di lapangan.',
        500000000, 320000000, 'Kesehatan'),
    new Program('pangan', 'Dapur Umum & Paket Pangan',
        'Distribusi ribuan porsi makanan hangat dan bahan pokok gandum untuk keluarga di pengungsian.',
        400000000, 280000000, 'Pangan'),
    new Program('air', 'Truk Air Bersih & Sanitasi',
        'Pasokan air layak minum dan penyediaan fasilitas sanitasi darurat untuk mencegah penyakit.',
        300000000, 250000000, 'Air & Sanitasi'),
]);

$programs = $lembaga->getPrograms();

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

function tanggal_indonesia($tanggal)
{
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
    ];
    $waktu = strtotime($tanggal);
    return date('j', $waktu) . ' ' . $bulan[(int) date('n', $waktu)] . ' ' . date('Y', $waktu);
}

/* ----- Statistik dari object Lembaga ----- */
$statistik = [
    ['angka' => rupiah($lembaga->totalTerkumpul()),                                    'label' => 'Total Dana Terhimpun'],
    ['angka' => number_format($lembaga->getJumlahDonatur(), 0, ',', '.') . ' Orang',   'label' => 'Jumlah Donatur Tergabung'],
    ['angka' => number_format($lembaga->getPenerimaManfaat(), 0, ',', '.') . ' Warga', 'label' => 'Penerima Manfaat Bantuan'],
];

/* Data per-id untuk panel detail di JavaScript */
$programs_by_id = $lembaga->getProgramsById();