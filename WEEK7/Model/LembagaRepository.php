<?php
/* =========================================================
   Model/LembagaRepository.php - Data Access (Week 7: MVC)
   Satu-satunya tempat data lembaga, program, dan agenda disimpan.
   Controller meminta data lewat class ini, bukan dari file lain.
   ========================================================= */
require_once __DIR__ . '/Lembaga.php';

class LembagaRepository
{
    // Mengembalikan object Lembaga yang berisi object Program
    public function ambilLembaga(): Lembaga
    {
        return new Lembaga('PeduliPalestina', '2026 - 2027', 4520, 12500, [
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
    }

    // Mengembalikan daftar agenda penyaluran (data mentah)
    public function ambilAgenda(): array
    {
        return [
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
    }
}
