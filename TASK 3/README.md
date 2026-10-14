# PeduliPalestina

Website penggalangan donasi kemanusiaan online yang aman, cepat, dan transparan, dengan laporan berkala serta pelacakan penyaluran bantuan secara terbuka.

## Cara Menjalankan

PHP dan `fetch()` butuh server, jadi jangan buka file langsung (`file://`).

```bash
php -S localhost:8000
```

Lalu buka `http://localhost:8000/index.php` (atau taruh folder di `htdocs` XAMPP).

Mode uji state API (Week 4 Task 03):

- `index.php?simulasi=lambat` : loading tampil 2 detik
- `index.php?simulasi=error` : pesan error + tombol "Coba Lagi"

## Struktur Folder

```
.
├── index.php          # halaman utama (konten dinamis dari PHP)
├── data.php           # data (variable, array), fungsi bantu, pemrosesan
├── api/programs.php   # endpoint JSON dari data.php
├── data/programs.json # sumber data cadangan untuk fetch
├── script.js
├── style.css
├── images/
└── README.md
```

## Checklist Week 4 - Connect PeduliPalestina to an API

- [x] Task 01 Connect to API: `fetch('api/programs.php')`, fallback `data/programs.json`
- [x] Task 02 Display API Data: data dirender ke DOM lewat JavaScript
- [x] Task 03 Handle API State:
  - [x] Request berhasil
  - [x] JSON terbaca
  - [x] Data tampil
  - [x] Loading ditampilkan ("Mengambil data program...")
  - [x] Error ditangani (pesan error + tombol Coba Lagi)

## Checklist Week 5 - PHP

- [x] Task 01 Create PHP Page
  - [x] PHP dapat dijalankan (`index.php`)
  - [x] Variable digunakan (`$lembaga`, `$jumlah_donatur`, dst. di `data.php`)
  - [x] Output tampil (section "Informasi Lembaga")
  - [x] HTML tetap terstruktur
- [x] Task 02 Process Data with PHP
  - [x] Array (`$programs`, `$agenda`, `$statistik`)
  - [x] Conditional (`status_program()`: Tercapai / Hampir Tercapai / Berjalan / Butuh Dukungan)
  - [x] Loop (`foreach` untuk kartu program, statistik, agenda, opsi form)
- [x] Task 03 Build Dynamic Server-Side Content
  - [x] Data berasal dari PHP
  - [x] Loop digunakan jika diperlukan
  - [x] Output HTML berhasil
  - [x] Tampilan tetap sesuai desain
  - [x] Tidak merusak halaman

## Teknologi

HTML5, CSS3 (variables, Flexbox, Grid, media query), JavaScript (Fetch API, async/await), PHP.

## Aksesibilitas

- Skip-link "Lewati ke konten utama"
- Teks alternatif (`alt`) pada semua gambar
- Label pada setiap input form
- Indikator fokus yang jelas untuk navigasi keyboard
- `aria-live` pada status API
- Menghormati preferensi `prefers-reduced-motion`
