<?php
require __DIR__ . '/data.php';
$profil = $lembaga->getProfile();   // method object Lembaga
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($profil['nama']) ?> - Salurkan Bantuan Kemanusiaan</title>
  <meta name="description" content="Salurkan donasi kemanusiaan untuk Palestina: bantuan medis, pangan, dan air bersih secara amanah dan transparan.">
  <link rel="icon" href="images/favicon.svg" type="image/svg+xml">
  <link rel="stylesheet" href="style.css">
  <script src="script.js" defer></script>
</head>
<body>
  <a class="skip-link" href="#main">Lewati ke konten utama</a>

  <header>
    <div class="logo">
      <a href="#hero"><img src="images/favicon.svg" alt="" width="32" height="32">Peduli<span>Palestina</span></a>
    </div>
    <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="menu" aria-label="Buka menu">
      <span></span><span></span><span></span>
    </button>
    <nav id="menu" aria-label="Navigasi utama">
      <ul>
        <li><a href="#hero">Beranda</a></li>
        <li><a href="#program-prioritas">Program Prioritas</a></li>
        <li><a href="#statistik">Statistik</a></li>
        <li><a href="#agenda">Agenda Penyaluran</a></li>
        <li><a href="#donasi" class="nav-cta">Donasi Sekarang</a></li>
      </ul>
    </nav>
  </header>

  <main id="main">
    <section id="hero">
      <div class="hero-teks">
        <h1>Ulurkan Tangan untuk Kemanusiaan di Palestina</h1>
        <p>Bantu saudara-saudara kita yang membutuhkan obat-obatan, paket pangan, dan air bersih secara amanah dan transparan.</p>
        <a href="#donasi" class="btn btn-terang">Donasi Sekarang &rarr;</a>
      </div>
      <img class="hero-gambar" src="images/hero.svg" alt="Ilustrasi bantuan kemanusiaan: hati, air bersih, dan paket medis" width="480" height="360">
    </section>

    <!-- Week 6: informasi dari object Lembaga (getProfile) -->
    <section id="info-lembaga">
      <h2>Informasi Lembaga</h2>
      <dl class="info-grid">
        <div class="info-item">
          <dt>Nama Lembaga</dt>
          <dd><?= e($profil['nama']) ?></dd>
        </div>
        <div class="info-item">
          <dt>Periode Kampanye</dt>
          <dd><?= e($profil['periode']) ?></dd>
        </div>
        <div class="info-item">
          <dt>Program Prioritas</dt>
          <dd>
            <?= $profil['jumlah_program'] ?> program
            <ul>
              <?php foreach ($programs as $p): ?>
                <li><?= e($p->getTitle()) ?></li>
              <?php endforeach; ?>
            </ul>
          </dd>
        </div>
        <div class="info-item">
          <dt>Status Program</dt>
          <dd>
            <span class="badge badge-<?= e($profil['status_kelas']) ?>"><?= e($profil['status_label']) ?></span>
            <small><?= $profil['persen'] ?>% dari target dana</small>
          </dd>
        </div>
      </dl>
    </section>

    <!-- Week 6: kartu dibuat dari object Program (getPrograms) -->
    <section id="program-prioritas">
      <h2>Program Prioritas Bantuan</h2>
      <?php foreach ($programs as $i => $p): ?>
        <?php
          $persen = $p->persen();
          list($label, $kelas) = $p->status();
        ?>
        <article>
          <img src="images/<?= e($p->getId()) ?>.svg" alt="<?= e($p->getTitle()) ?>" width="320" height="180" loading="lazy">
          <div class="kartu-status"><span class="badge badge-<?= e($kelas) ?>"><?= e($label) ?> &middot; <?= $persen ?>%</span></div>
          <h3><?= $i + 1 ?>. <?= e($p->getTitle()) ?></h3>
          <p><?= e($p->getDescription()) ?></p>
          <button type="button" class="btn-detail" data-program="<?= e($p->getId()) ?>">Lihat Detail</button>
        </article>
      <?php endforeach; ?>

      <div id="detail-program" class="detail" hidden>
        <button type="button" class="detail-tutup" aria-label="Tutup detail">&times;</button>
        <h3 id="detail-judul"></h3>
        <p id="detail-deskripsi"></p>
        <progress id="detail-progress" max="100" value="0"></progress>
        <p id="detail-dana"></p>
        <button type="button" id="detail-donasi">Donasi untuk program ini</button>
      </div>
    </section>

    <section id="statistik">
      <h2>Statistik Capaian Donasi</h2>
      <?php foreach ($statistik as $s): ?>
        <div class="stat">
          <p class="stat-angka"><?= e($s['angka']) ?></p>
          <p class="stat-label"><?= e($s['label']) ?></p>
        </div>
      <?php endforeach; ?>
    </section>

    <!-- Week 4: data dari API (api/programs.php) lewat fetch -->
    <section id="api-programs" aria-live="polite">
      <h2>Data API Program Kemanusiaan</h2>
      <div class="api-status api-loading" id="api-status">Mengambil data program...</div>
      <div class="api-actions">
        <button type="button" class="btn btn-api" id="refresh-api">Refresh Data</button>
      </div>
      <div class="api-list" id="api-program-list"></div>
    </section>

    <section id="agenda">
      <h2>Agenda &amp; Laporan Penyaluran</h2>
      <?php if (empty($agenda)): ?>
        <p>Belum ada agenda penyaluran.</p>
      <?php else: ?>
        <?php foreach ($agenda as $a): ?>
          <article>
            <img src="images/<?= e($a['gambar']) ?>.svg" alt="<?= e($a['alt']) ?>" width="320" height="180" loading="lazy">
            <div>
              <time datetime="<?= e($a['tanggal']) ?>"><?= e(tanggal_indonesia($a['tanggal'])) ?></time>
              <h3><?= e($a['judul']) ?></h3>
              <p><?= e($a['isi']) ?></p>
            </div>
          </article>
        <?php endforeach; ?>
      <?php endif; ?>
    </section>

    <section id="donasi">
      <h2>Formulir Donasi Kemanusiaan</h2>
      <form action="#" method="post" enctype="multipart/form-data">
        <div>
          <label for="nama">Nama Donatur:</label>
          <input type="text" id="nama" name="nama" placeholder="Isi 'Hamba Allah' jika anonim">
        </div>
        <div>
          <label for="program">Pilih Program Bantuan:</label>
          <select id="program" name="program">
            <?php foreach ($programs as $p): ?>
              <option value="<?= e($p->getId()) ?>"><?= e($p->getTitle()) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div>
          <label for="nominal">Nominal Donasi (Rp):</label>
          <input type="number" id="nominal" name="nominal" min="1000" step="1000" placeholder="Contoh: 100000" required>
        </div>
        <div>
          <label for="doa">Doa &amp; Pesan Kebaikan:</label>
          <textarea id="doa" name="doa" rows="3" placeholder="Tuliskan doa untuk warga Palestina..."></textarea>
        </div>
        <div>
          <label for="bukti">Unggah Bukti Transfer:</label>
          <input type="file" id="bukti" name="bukti" accept="image/*">
        </div>
        <button type="submit">Kirim Donasi</button>
      </form>
    </section>
  </main>

  <footer>
    <p>&copy; <?= date('Y') ?> <?= e($profil['nama']) ?> - Lembaga Penggalangan Dana Kemanusiaan Terpercaya</p>
  </footer>

  <!-- Data dari PHP diteruskan ke JavaScript (panel detail) -->
  <script>
    const dataProgram = <?= json_encode($programs_by_id, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
  </script>
</body>
</html>