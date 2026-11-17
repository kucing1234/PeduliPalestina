# PeduliPalestina - Week 9: Laravel + CRUD + Database

Fitur **Program Management**: data program bantuan disimpan di database dan dikelola lewat Laravel (Migration, Model, Eloquent, CRUD). Tidak ada data yang ditulis langsung di HTML.

## Cara Pasang

Folder ini hanya berisi file buatan sendiri. Kerangka Laravel dibuat dulu dengan Composer.

```bash
# 1. Dari folder repo (PeduliPalestina-main), buat project Laravel bernama WEEK9
composer create-project laravel/laravel WEEK9

# 2. Salin semua isi folder ini ke dalam WEEK9, timpa file yang sama
#    (routes/web.php dan database/seeders/DatabaseSeeder.php akan tertimpa)

# 3. Buat tabel dan isi data awal
cd WEEK9
php artisan migrate --seed
#    Jika ditanya "create the SQLite database?", jawab yes

# 4. Jalankan
php artisan serve
```

Buka `http://127.0.0.1:8000/programs`.

### Memakai MySQL (XAMPP) 
Buat database `peduli_palestina` di phpMyAdmin, lalu ubah `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=peduli_palestina
DB_USERNAME=root
DB_PASSWORD=
```

Lalu jalankan `php artisan migrate:fresh --seed`.

## Struktur File

```
WEEK9/
├── database/
│   ├── migrations/2026_11_17_000000_create_programs_table.php   # Task 01
│   └── seeders/ProgramSeeder.php, DatabaseSeeder.php             # data awal (Program::create)
├── app/
│   ├── Models/Program.php                                        # Task 02
│   └── Http/Controllers/ProgramController.php                    # Task 03 (index, create, store, edit, update, destroy)
├── routes/web.php                                                # Route::resource + /uji-eloquent
├── resources/views/
│   ├── layouts/app.blade.php                                     # header, footer, menu PeduliPalestina
│   └── programs/ index, create, edit, _form .blade.php
└── public/ css/style.css, js/menu.js, images/favicon.svg
```

## Checklist

**Task 01 - Create Database Structure**
- [x] Migration `create_programs_table` dibuat
- [x] Tabel `programs` dibuat lewat `php artisan migrate`
- [x] Kolom `id`, `nama`, `deskripsi`, `timestamps`
- [x] Kolom tambahan `kategori`, `target`, `terkumpul` (untuk progress bar PeduliPalestina)

**Task 02 - Build Program Model**
- [x] `app/Models/Program.php` extends `Model`, dengan `$fillable`
- [x] `Program::all()` dan `Program::find(1)` (lihat `/uji-eloquent`)
- [x] `Program::create()` dipakai di seeder dan di `store()`

**Task 03 - Build Program CRUD**
- [x] Create: form tambah, simpan ke database
- [x] Read: tabel program dari database
- [x] Update: form edit
- [x] Delete: tombol Hapus dengan konfirmasi
- [x] Tidak ada data hard-code di view
- [x] Tampilan tetap PeduliPalestina (memakai `style.css` yang sama)

## Cara Demo (sesuai slide 14)
1. **Database**: buka tabel `programs` (phpMyAdmin / DB Browser for SQLite) atau jalankan `php artisan tinker` lalu `App\Models\Program::all()`.
2. **Create**: klik "+ Tambah Program", isi form, lalu cek data bertambah.
3. **Read**: halaman `/programs` menampilkan semua program.
4. **Update**: klik Edit, ubah, lalu cek data berubah.
5. **Delete**: klik Hapus, konfirmasi, lalu cek data berkurang.
6. **Code**: tunjukkan migration, model, dan query Eloquent di controller.

## Jawaban Refleksi (slide 15)
1. **Fungsi Migration:** mendefinisikan dan mengelola struktur database lewat kode PHP, sehingga tabel bisa dibuat ulang atau dibatalkan dengan `migrate` dan `migrate:rollback`.
2. **Fungsi Model:** mewakili satu tabel di database. `Program` menghubungkan kode Laravel dengan tabel `programs`, dan `$fillable` menentukan kolom yang boleh diisi.
3. **Fungsi Eloquent:** ORM Laravel yang membuat kita membaca dan menulis database dengan method PHP seperti `all()`, `find()`, `create()`, tanpa menulis query SQL manual.
4. **`Program::all()` vs `Program::find(1)`:** `all()` mengambil semua baris (banyak object), `find(1)` hanya mengambil satu baris berdasarkan id (satu object).
5. **CRUD:** Create, Read, Update, Delete, yaitu empat operasi dasar untuk mengelola data: tambah, lihat, ubah, hapus.

**Apa yang berubah saat PeduliPalestina memakai database?** Data tidak lagi hard-code di kode. Data tersimpan di database, dibaca Laravel lewat Eloquent, lalu ditampilkan di view.

## Commit & Push
```bash
git add .
git commit -m "Week 9: Laravel CRUD program dengan database"
git push
```
