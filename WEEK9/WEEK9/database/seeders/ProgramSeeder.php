<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Isi awal tabel programs memakai Program::create() (Eloquent).
     */
    public function run(): void
    {
        $data = [
            [
                'nama'      => 'Bantuan Medis & Ambulans Darurat',
                'deskripsi' => 'Obat-obatan esensial, kasa steril, dan operasional tim medis darurat untuk keluarga yang terluka dan sakit.',
                'kategori'  => 'Kesehatan',
                'target'    => 500000000,
                'terkumpul' => 320000000,
            ],
            [
                'nama'      => 'Dapur Umum & Paket Pangan',
                'deskripsi' => 'Distribusi makanan hangat dan bahan pokok untuk keluarga di pengungsian supaya kebutuhan pokok tetap terpenuhi.',
                'kategori'  => 'Pangan',
                'target'    => 400000000,
                'terkumpul' => 280000000,
            ],
            [
                'nama'      => 'Truk Air Bersih & Sanitasi',
                'deskripsi' => 'Pasokan air bersih, sanitasi, dan fasilitas kebersihan untuk mencegah penularan penyakit.',
                'kategori'  => 'Air & Sanitasi',
                'target'    => 300000000,
                'terkumpul' => 250000000,
            ],
            [
                'nama'      => 'Tenda Pengungsian',
                'deskripsi' => 'Tenda, selimut, dan perlengkapan tidur untuk keluarga yang kehilangan tempat tinggal.',
                'kategori'  => 'Tempat Tinggal',
                'target'    => 350000000,
                'terkumpul' => 120000000,
            ],
        ];

        foreach ($data as $item) {
            Program::create($item);
        }
    }
}
