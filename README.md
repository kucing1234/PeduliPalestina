# PeduliPalestina

Website penggalangan donasi kemanusiaan online yang aman, cepat, dan transparan, dengan laporan berkala serta pelacakan penyaluran bantuan secara terbuka.

> Tugas Web Programming, Pertemuan 2, Task 03: *Refine the Interface* (HTML + CSS).

## Latar Belakang Masalah

Masyarakat ingin berdonasi untuk warga Palestina, tetapi sering ragu karena:

- kurangnya transparansi alokasi dana,
- proses donasi yang berbelit,
- minimnya laporan berkala mengenai bukti penyaluran bantuan (medis, pangan, shelter) di lapangan.

## Target Pengguna

Masyarakat umum, komunitas sosial/keagamaan, mahasiswa, dan donatur perorangan maupun kelompok.

## Solusi

Website **"PeduliPalestina"** yang menyediakan:

1. Katalog program bantuan darurat (Paket Pangan, Obat/Medis, Air Bersih, Tenda Pengungsian).
2. Form donasi dengan pilihan nominal donasi, pesan doa, dan upload bukti transfer.
3. Tracking progress bar dana terkumpul dan jumlah donatur.
4. Laporan update penyaluran bantuan (foto dokumentasi dan catatan kegiatan di lapangan).
5. Dashboard admin untuk verifikasi donasi dan update kabar terbaru.

## Status Implementasi

| Fitur | Status |
|---|---|
| Katalog program prioritas | Sudah (3 program: medis, pangan, air bersih) |
| Form donasi + upload bukti transfer | Sudah (tampilan form; belum terhubung ke server) |
| Statistik dana dan donatur | Sudah (angka statis; progress bar belum ada) |
| Agenda dan laporan penyaluran | Sudah (2 laporan contoh, dengan gambar) |
| Dashboard admin | Belum (butuh backend) |

## Checklist Task 03

- [x] Semantic HTML (`header`, `nav`, `main`, `section`, `article`, `time`, `footer`)
- [x] Struktur halaman jelas
- [x] CSS diterapkan
- [x] Layout rapi
- [x] Responsive (mobile, tablet, desktop; menu hamburger di layar kecil)
- [x] Tidak ada horizontal overflow

## Teknologi

- HTML5
- CSS3 (CSS variables, Flexbox, Grid, media query)
- JavaScript sederhana (hanya untuk menu hamburger)

## Struktur Folder

```
.
├── index.html
├── style.css
├── script.js
└── README.md
```

Gambar sudah tertanam langsung di `index.html` (SVG), jadi tidak perlu folder tambahan.

## Cara Menjalankan

1. Simpan semua file di satu folder.
2. Buka `index.html` di browser (klik dua kali), atau
3. Gunakan ekstensi **Live Server** di VS Code: klik kanan `index.html` → **Open with Live Server**.

## Aksesibilitas

- Skip-link "Lewati ke konten utama"
- Teks alternatif (`alt`) pada semua gambar
- Label pada setiap input form
- Indikator fokus yang jelas untuk navigasi keyboard
- Menghormati preferensi `prefers-reduced-motion`

## Pengembangan Selanjutnya

- Progress bar dana terkumpul terhadap target
- Backend untuk menyimpan donasi dan verifikasi bukti transfer
- Dashboard admin untuk verifikasi donasi dan update kabar
- Halaman katalog lengkap (termasuk Tenda Pengungsian)

## Pembuat

- Nama: *(isi nama dan NIM)*
- Mata kuliah: Web Programming
- Universitas Muhammadiyah Malang
