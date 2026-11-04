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

## Struktur Folder (MVC - Week 7)

```
.
├── index.php                      # front controller: terima request, teruskan ke Controller
├── Controller/
│   └── LembagaController.php      # index(), show(), process(), api()
├── Model/
│   ├── Lembaga.php                # class Lembaga (data + logika lembaga)
│   ├── Program.php                # class Program (data + logika program)
│   ├── Donasi.php                 # data + validasi donasi
│   └── LembagaRepository.php      # sumber data lembaga, program, agenda
├── View/
│   ├── helpers.php                # e(), rupiah(), tanggal_indonesia()
│   ├── lembaga-page.php           # halaman utama
│   ├── program-detail.php         # halaman detail satu program
│   ├── not-found.php              # program tidak ditemukan (404)
│   └── partials/
│       ├── header.php
│       └── footer.php
├── api/programs.php               # endpoint JSON, diteruskan ke Controller::api()
├── data/programs.json             # sumber data cadangan untuk fetch
├── script.js
├── style.css
├── images/
└── README.md
```

Alur: `Request -> index.php -> Controller -> Model -> Controller -> View -> HTML`

| URL | Method Controller |
| --- | --- |
| `index.php` | `index()` halaman utama |
| `index.php?aksi=show&id=medis` | `show('medis')` halaman detail program |
| `POST index.php?aksi=process` | `process()` memproses form donasi |
| `api/programs.php` | `api()` data JSON program |

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

## Checklist Week 7 - From OOP to MVC (Sprint 06)

- [x] Task 01 Design the MVC Structure
  - [x] Model ditentukan: `Lembaga`, `Program`, `Donasi`, `LembagaRepository` (folder `Model/`)
  - [x] View ditentukan: `lembaga-page.php`, `program-detail.php`, `not-found.php`, partials (folder `View/`)
  - [x] Controller ditentukan: `LembagaController` (folder `Controller/`)
  - [x] Tanggung jawab masing-masing jelas (Model = data, View = tampilan, Controller = alur)
- [x] Task 02 Build the Controller
  - [x] Controller berjalan dan request diterima lewat `index.php`
  - [x] Method dapat dijalankan: `index()`, `show()`, `process()`, `api()`
  - [x] Model dapat dipanggil (`LembagaRepository`, `Donasi`)
  - [x] View dapat ditampilkan lewat `render()`
- [x] Task 03 Connect Model, Controller & View
  - [x] Data berasal dari Model
  - [x] Controller memproses data (statistik, validasi donasi)
  - [x] Data dikirim ke View, View hanya menampilkan
  - [x] Tidak ada error (diuji: halaman utama, detail, 404, API, form donasi valid/tidak valid)

### Jawaban Pertanyaan Demo

1. **Fungsi Controller:** menerima request, memanggil Model, lalu meneruskan hasilnya ke View (`LembagaController`).
2. **Data yang dikelola Model:** nama lembaga, periode, daftar program (judul, target, dana terkumpul, kategori), agenda, dan data donasi beserta validasinya.
3. **Yang ditampilkan View:** halaman utama, kartu program, statistik, agenda, form donasi, halaman detail program, dan pesan hasil donasi.
4. **Controller ke Model:** lewat object, misalnya `$this->repository->ambilLembaga()`, `$lembaga->cariProgram($id)`, dan `new Donasi($_POST)`.
5. **Data sampai ke View:** Controller memanggil `render('lembaga-page', $data)`; `extract()` membuat tiap key menjadi variabel (`$profil`, `$programs`, dst.) yang dipakai file View.

### Jawaban Pertanyaan Review

Bagian yang jadi lebih mudah dikelola: data dan aturan program (Model) kini terpisah dari HTML. Mengubah data program cukup di `LembagaRepository`, mengubah tampilan cukup di `View/`, dan menambah halaman baru cukup menambah method Controller. Sebelumnya `data.php` memuat data, fungsi bantu, dan statistik sekaligus.

## Teknologi

HTML5, CSS3 (variables, Flexbox, Grid, media query), JavaScript (Fetch API, async/await), PHP.

## Aksesibilitas

- Skip-link "Lewati ke konten utama"
- Teks alternatif (`alt`) pada semua gambar
- Label pada setiap input form
- Indikator fokus yang jelas untuk navigasi keyboard
- `aria-live` pada status API
- Menghormati preferensi `prefers-reduced-motion`
