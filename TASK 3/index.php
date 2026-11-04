<?php
require __DIR__ . '/data.php';
$profil = $lembaga->getProfile();   // method object Lembaga

// Konten statis (keunggulan & testimoni). Testimoni hanya contoh, ganti dengan yang asli.
$keunggulan = [
  ['Amanah', 'Dana disalurkan sesuai program yang Anda pilih, tanpa dialihkan ke keperluan lain.', '<path d="M12 3l8 3v6c0 4.5-3.4 8-8 9-4.6-1-8-4.5-8-9V6z"/><path d="M9 12l2 2 4-4"/>'],
  ['Transparan', 'Capaian dana dan laporan penyaluran dapat Anda pantau kapan saja.', '<path d="M3 3v18h18"/><path d="M7 15l4-4 3 3 5-6"/>'],
  ['Laporan penyaluran', 'Agenda dan dokumentasi penyaluran dibagikan agar Anda tahu dampak donasi Anda.', '<rect x="3" y="4" width="18" height="17" rx="3"/><path d="M8 2v4M16 2v4M3 10h18"/>'],
];
$testimoni = [
  ['AR', 'Ayu Rahmawati', 'Prosesnya mudah, dan saya bisa melihat laporan penyaluran. Jadi tenang saat berdonasi.'],
  ['BP', 'Bima Pratama', 'Saya bisa memilih program yang ingin dibantu. Tampilannya sederhana, tidak membingungkan.'],
  ['SN', 'Sari Nugraha', 'Kami mengumpulkan donasi dari teman-teman kampus lewat sini, dan semuanya tercatat rapi.'],
];
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($profil['nama']) ?> - Salurkan Bantuan Kemanusiaan</title>
  <meta name="description" content="Salurkan donasi kemanusiaan untuk Palestina: bantuan medis, pangan, dan air bersih secara amanah dan transparan.">
  <link rel="icon" href="images/favicon.svg" type="image/svg+xml">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { theme: { extend: {
      fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'], display: ['Outfit', 'Inter', 'sans-serif'] },
      colors: { charcoal: '#1b211e', ink: '#55605a', mist: '#f4f6f4', paper: '#fcfcfa',
                emerald: { DEFAULT: '#0b6b4d', dark: '#085440', soft: '#e5f3ec' } },
      maxWidth: { page: '1200px' },
    } } };
  </script>

  <style>
    [hidden] { display: none !important; }
    body { line-height: 1.7; letter-spacing: .005em; -webkit-font-smoothing: antialiased; }
    h1, h2, h3 { letter-spacing: -.02em; line-height: 1.15; }
    .t-hero { font-size: clamp(2.25rem, 1.4rem + 4.2vw, 4rem); }
    .t-h2   { font-size: clamp(1.75rem, 1.3rem + 2vw, 2.75rem); }
    .t-lead { font-size: clamp(1.05rem, 1rem + .35vw, 1.25rem); }
    :focus-visible { outline: 3px solid #0b6b4d; outline-offset: 3px; border-radius: 8px; }

    .reveal { opacity: 0; transform: translateY(18px); transition: opacity .5s ease-out, transform .5s ease-out; }
    .reveal.visible { opacity: 1; transform: none; }
    .lift { transition: transform .3s ease-out, box-shadow .3s ease-out; }
    .lift:hover { transform: scale(1.02); box-shadow: 0 18px 40px -16px rgba(27,33,30,.18); }
    .btn { transition: transform .3s ease-out, background-color .3s ease-out, box-shadow .3s ease-out; }
    .btn:hover { transform: scale(1.03); }

    /* Navigasi */
    .skip-link { position: absolute; left: 1rem; top: -4rem; background: #0b6b4d; color: #fff; padding: .6rem 1rem; border-radius: 8px; z-index: 100; }
    .skip-link:focus { top: 1rem; }
    #menu ul { display: flex; align-items: center; gap: 2rem; list-style: none; margin: 0; padding: 0; }
    #menu a { font-size: .875rem; color: #55605a; transition: color .3s ease-out; }
    #menu a:hover { color: #1b211e; }
    #menu a.nav-cta { display: inline-flex; align-items: center; min-height: 44px; padding: 0 1.25rem; border-radius: 999px; background: #0b6b4d; color: #fff; font-weight: 500; }
    #menu a.nav-cta:hover { background: #085440; color: #fff; }
    .menu-toggle { display: none; width: 44px; height: 44px; padding: 0; background: none; border: 0; border-radius: 12px; cursor: pointer; flex-direction: column; align-items: center; justify-content: center; gap: 5px; }
    .menu-toggle span { display: block; width: 20px; height: 2px; background: #1b211e; border-radius: 2px; transition: transform .3s ease-out, opacity .3s ease-out; }
    .menu-toggle[aria-expanded="true"] span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
    .menu-toggle[aria-expanded="true"] span:nth-child(2) { opacity: 0; }
    .menu-toggle[aria-expanded="true"] span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
    @media (max-width: 767px) {
      .menu-toggle { display: flex; }
      #menu { position: absolute; left: 0; right: 0; top: 100%; background: #fcfcfa; display: grid; grid-template-rows: 0fr; transition: grid-template-rows .4s ease-out; }
      #menu > ul { overflow: hidden; min-height: 0; flex-direction: column; align-items: stretch; gap: 0; padding: 0 1.25rem; }
      #menu.terbuka { grid-template-rows: 1fr; border-bottom: 1px solid rgba(0,0,0,.06); }
      #menu.terbuka > ul { padding-bottom: 1.25rem; }
      #menu a { display: flex; align-items: center; min-height: 44px; padding: 0 .75rem; border-radius: 12px; font-size: 1rem; }
      #menu a:hover { background: #f4f6f4; }
      #menu a.nav-cta { justify-content: center; margin-top: .5rem; min-height: 48px; }
    }

    /* Badge */
    .badge { display: inline-block; padding: .15rem .7rem; border-radius: 999px; font-size: .8rem; font-weight: 600; background: #e5f3ec; color: #085440; }
    .badge-tercapai, .badge-hampir { background: #e5f3ec; color: #085440; }
    .badge-berjalan { background: #fdf3dc; color: #96651a; }
    .badge-mendesak { background: #fdecef; color: #c0293f; }

    /* Progress */
    progress { width: 100%; height: 10px; border: 0; border-radius: 999px; overflow: hidden; background: #e8ece9; accent-color: #0b6b4d; }
    progress::-webkit-progress-bar { background: #e8ece9; }
    progress::-webkit-progress-value { background: #0b6b4d; border-radius: 999px; }
    progress::-moz-progress-bar { background: #0b6b4d; }

    /* Panel detail (dibuka script.js) */
    .detail { position: fixed; z-index: 80; left: 50%; top: 50%; transform: translate(-50%, -50%); width: min(92vw, 460px); max-height: 90vh; overflow: auto; background: #fff; border-radius: 20px; padding: 1.75rem; box-shadow: 0 0 0 100vmax rgba(10,30,22,.5), 0 24px 60px rgba(0,0,0,.3); }
    .detail-tutup { position: absolute; top: .75rem; right: .75rem; width: 44px; height: 44px; border: 0; border-radius: 999px; background: #f4f6f4; font-size: 1.5rem; line-height: 1; cursor: pointer; }
    .detail-tutup:hover { background: #e8ece9; }
    #detail-donasi { min-height: 48px; width: 100%; margin-top: .75rem; border: 0; border-radius: 999px; background: #0b6b4d; color: #fff; font: inherit; font-weight: 500; cursor: pointer; transition: background-color .3s ease-out; }
    #detail-donasi:hover { background: #085440; }

    /* API */
    .api-status { padding: .85rem 1.1rem; border-radius: 12px; font-weight: 500; background: #e5f3ec; color: #085440; margin-bottom: 1rem; }
    .api-loading { background: #fdf3dc; color: #96651a; }
    .api-error, .api-gagal { background: #fdecef; color: #c0293f; }
    .api-list { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1rem; }
    .api-card { background: #fff; border: 1px solid rgba(0,0,0,.06); border-radius: 16px; padding: 1.25rem; transition: transform .3s ease-out, box-shadow .3s ease-out; }
    .api-card:hover { transform: scale(1.02); box-shadow: 0 18px 40px -16px rgba(27,33,30,.18); }
    .api-kategori { display: inline-block; padding: .1rem .65rem; border-radius: 999px; background: #e5f3ec; color: #085440; font-size: .8rem; font-weight: 600; }
    .api-card h3 { margin: .75rem 0 .4rem; font-family: Outfit, Inter, sans-serif; font-size: 1.1rem; font-weight: 600; }
    .api-card p { margin: 0 0 1rem; color: #55605a; font-size: .93rem; }
    .api-meta { display: flex; justify-content: space-between; margin-bottom: .5rem; font-size: .85rem; font-weight: 600; }
    .api-bar { height: 8px; border-radius: 999px; background: #e8ece9; overflow: hidden; }
    .api-bar span { display: block; height: 100%; border-radius: 999px; background: #0b6b4d; }
    #retry-api { min-height: 44px; margin-left: .5rem; padding: 0 1.1rem; border: 0; border-radius: 999px; background: #c0293f; color: #fff; font: inherit; font-weight: 500; cursor: pointer; }
    #refresh-api:disabled { opacity: .6; cursor: wait; }

    /* Form */
    .field { width: 100%; min-height: 48px; padding: .7rem 1rem; border: 1.5px solid #dfe5e1; border-radius: 12px; background: #fcfcfa; font: inherit; transition: border-color .3s ease-out, box-shadow .3s ease-out; }
    .field:focus { outline: none; border-color: #0b6b4d; box-shadow: 0 0 0 4px rgba(11,107,77,.12); }

    @media (prefers-reduced-motion: reduce) {
      .reveal { opacity: 1; transform: none; transition: none; }
      * { transition-duration: .01ms !important; scroll-behavior: auto !important; }
    }
  </style>
  <script src="script.js" defer></script>
</head>
<body class="bg-paper font-sans text-charcoal">
  <a class="skip-link" href="#main">Lewati ke konten utama</a>

  <header class="sticky top-0 z-50 border-b border-black/5 bg-paper/85 backdrop-blur">
    <div class="mx-auto flex h-16 max-w-page items-center justify-between px-5 sm:px-8">
      <a href="#hero" class="flex items-center gap-2 font-display text-xl font-semibold tracking-tight">
        <img src="images/favicon.svg" alt="" width="28" height="28">Peduli<span class="-ml-1.5 text-emerald">Palestina</span>
      </a>
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
    </div>
  </header>

  <main id="main">
    <!-- Hero -->
    <section id="hero" class="mx-auto max-w-page px-5 pb-16 pt-16 sm:px-8 sm:pb-24 sm:pt-24">
      <div class="mx-auto max-w-3xl text-center">
        <h1 class="t-hero reveal font-display font-semibold">Ulurkan Tangan untuk Kemanusiaan di Palestina</h1>
        <p class="t-lead reveal mx-auto mt-6 max-w-2xl text-ink" style="transition-delay:80ms">Bantu saudara-saudara kita yang membutuhkan obat-obatan, paket pangan, dan air bersih secara amanah dan transparan.</p>
        <div class="reveal mt-9 flex flex-col justify-center gap-3 sm:flex-row" style="transition-delay:160ms">
          <a href="#donasi" class="btn inline-flex min-h-[52px] items-center justify-center rounded-full bg-emerald px-8 font-medium text-white shadow-lg shadow-emerald/20 hover:bg-emerald-dark">Donasi Sekarang</a>
          <a href="#program-prioritas" class="btn inline-flex min-h-[52px] items-center justify-center rounded-full border border-charcoal/15 px-8 font-medium hover:bg-mist">Lihat program bantuan</a>
        </div>
      </div>
      <img class="reveal mx-auto mt-14 w-full max-w-md" style="transition-delay:240ms" src="images/hero.svg" alt="Ilustrasi bantuan kemanusiaan: hati, air bersih, dan paket medis" width="480" height="360">
    </section>

    <!-- Informasi lembaga (object Lembaga::getProfile) -->
    <section id="info-lembaga" class="bg-mist py-16 sm:py-20">
      <div class="mx-auto max-w-page px-5 sm:px-8">
        <h2 class="t-h2 reveal mb-8 font-display font-semibold">Informasi Lembaga</h2>
        <dl class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
          <div class="reveal rounded-2xl bg-white p-5">
            <dt class="text-sm font-medium text-ink">Nama Lembaga</dt>
            <dd class="mt-1 font-semibold"><?= e($profil['nama']) ?></dd>
          </div>
          <div class="reveal rounded-2xl bg-white p-5">
            <dt class="text-sm font-medium text-ink">Periode Kampanye</dt>
            <dd class="mt-1 font-semibold"><?= e($profil['periode']) ?></dd>
          </div>
          <div class="reveal rounded-2xl bg-white p-5">
            <dt class="text-sm font-medium text-ink">Program Prioritas</dt>
            <dd class="mt-1 font-semibold">
              <?= $profil['jumlah_program'] ?> program
              <ul class="mt-1 list-disc pl-5 text-sm font-normal text-ink">
                <?php foreach ($programs as $p): ?>
                  <li><?= e($p->getTitle()) ?></li>
                <?php endforeach; ?>
              </ul>
            </dd>
          </div>
          <div class="reveal rounded-2xl bg-white p-5">
            <dt class="text-sm font-medium text-ink">Status Program</dt>
            <dd class="mt-1">
              <span class="badge badge-<?= e($profil['status_kelas']) ?>"><?= e($profil['status_label']) ?></span>
              <small class="mt-1 block text-ink"><?= $profil['persen'] ?>% dari target dana</small>
            </dd>
          </div>
        </dl>
      </div>
    </section>

    <!-- Program prioritas (object Program) -->
    <section id="program-prioritas" class="mx-auto max-w-page px-5 py-20 sm:px-8 sm:py-28">
      <div class="reveal mx-auto max-w-2xl text-center">
        <h2 class="t-h2 font-display font-semibold">Program Prioritas Bantuan</h2>
        <p class="t-lead mt-4 text-ink">Kebutuhan paling mendesak yang bisa Anda bantu hari ini.</p>
      </div>
      <div class="mt-14 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($programs as $i => $p): ?>
          <?php
            $persen = $p->persen();
            list($label, $kelas) = $p->status();
          ?>
          <article class="reveal lift flex flex-col rounded-2xl border border-black/5 bg-white p-4 pb-6">
            <img class="w-full rounded-xl bg-emerald-soft" src="images/<?= e($p->getId()) ?>.svg" alt="<?= e($p->getTitle()) ?>" width="320" height="180" loading="lazy">
            <div class="mt-4 px-2">
              <div class="kartu-status flex items-center justify-between gap-2">
                <span class="badge badge-<?= e($kelas) ?>"><?= e($label) ?></span>
                <span class="text-sm font-semibold"><?= $persen ?>%</span>
              </div>
              <progress class="mt-3" max="100" value="<?= (int)$persen ?>" aria-label="Capaian dana"></progress>
              <h3 class="mt-4 font-display text-xl font-semibold"><?= $i + 1 ?>. <?= e($p->getTitle()) ?></h3>
              <p class="mt-2 text-ink"><?= e($p->getDescription()) ?></p>
              <button type="button" class="btn-detail btn mt-5 min-h-[48px] w-full rounded-full bg-emerald-soft font-medium text-emerald-dark hover:bg-emerald hover:text-white" data-program="<?= e($p->getId()) ?>">Lihat Detail</button>
            </div>
          </article>
        <?php endforeach; ?>
      </div>

      <div id="detail-program" class="detail" hidden>
        <button type="button" class="detail-tutup" aria-label="Tutup detail">&times;</button>
        <h3 id="detail-judul" class="pr-10 font-display text-xl font-semibold"></h3>
        <p id="detail-deskripsi" class="mt-2 text-ink"></p>
        <progress id="detail-progress" max="100" value="0"></progress>
        <p id="detail-dana" class="mt-2 text-sm font-medium"></p>
        <button type="button" id="detail-donasi">Donasi untuk program ini</button>
      </div>
    </section>

    <!-- Keunggulan -->
    <section class="bg-mist py-20 sm:py-28">
      <div class="mx-auto max-w-page px-5 sm:px-8">
        <div class="reveal mx-auto max-w-2xl text-center">
          <h2 class="t-h2 font-display font-semibold">Berdonasi dengan tenang</h2>
          <p class="t-lead mt-4 text-ink">Kami menjaga setiap kebaikan Anda sampai ke tangan yang membutuhkan.</p>
        </div>
        <div class="mt-14 grid gap-6 md:grid-cols-3">
          <?php foreach ($keunggulan as $k): ?>
            <article class="reveal lift rounded-2xl bg-white p-7">
              <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-soft text-emerald">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?= $k[2] ?></svg>
              </div>
              <h3 class="font-display text-xl font-semibold"><?= e($k[0]) ?></h3>
              <p class="mt-2 text-ink"><?= e($k[1]) ?></p>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Statistik -->
    <section id="statistik" class="mx-auto max-w-page px-5 py-20 sm:px-8 sm:py-28">
      <h2 class="t-h2 reveal mb-10 text-center font-display font-semibold">Statistik Capaian Donasi</h2>
      <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($statistik as $s): ?>
          <div class="stat reveal rounded-2xl bg-emerald p-6 text-white">
            <p class="stat-angka font-display text-4xl font-semibold leading-tight"><?= e($s['angka']) ?></p>
            <p class="stat-label mt-1 text-white/80"><?= e($s['label']) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Data dari API (api/programs.php) lewat fetch di script.js -->
    <section id="api-programs" aria-live="polite" class="bg-mist py-20 sm:py-28">
      <div class="mx-auto max-w-page px-5 sm:px-8">
        <h2 class="t-h2 reveal mb-6 font-display font-semibold">Data API Program Kemanusiaan</h2>
        <div class="api-status api-loading" id="api-status">Mengambil data program...</div>
        <div class="mb-6">
          <button type="button" class="btn min-h-[48px] rounded-full bg-emerald px-6 font-medium text-white hover:bg-emerald-dark" id="refresh-api">Refresh Data</button>
        </div>
        <div class="api-list" id="api-program-list"></div>
      </div>
    </section>

    <!-- Agenda -->
    <section id="agenda" class="mx-auto max-w-page px-5 py-20 sm:px-8 sm:py-28">
      <h2 class="t-h2 reveal mb-10 font-display font-semibold">Agenda &amp; Laporan Penyaluran</h2>
      <?php if (empty($agenda)): ?>
        <p class="text-ink">Belum ada agenda penyaluran.</p>
      <?php else: ?>
        <div class="grid gap-5">
          <?php foreach ($agenda as $a): ?>
            <article class="reveal lift grid items-center gap-5 rounded-2xl border border-black/5 bg-white p-4 md:grid-cols-[260px_1fr]">
              <img class="w-full rounded-xl bg-emerald-soft" src="images/<?= e($a['gambar']) ?>.svg" alt="<?= e($a['alt']) ?>" width="320" height="180" loading="lazy">
              <div class="md:pr-4">
                <time class="text-sm font-semibold text-emerald" datetime="<?= e($a['tanggal']) ?>"><?= e(tanggal_indonesia($a['tanggal'])) ?></time>
                <h3 class="mt-1 font-display text-xl font-semibold"><?= e($a['judul']) ?></h3>
                <p class="mt-2 text-ink"><?= e($a['isi']) ?></p>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>

    <!-- Kata donatur (contoh) -->
    <section class="bg-mist py-20 sm:py-28">
      <div class="mx-auto max-w-page px-5 sm:px-8">
        <h2 class="t-h2 reveal text-center font-display font-semibold">Kata para donatur</h2>
        <div class="mt-12 grid gap-6 lg:grid-cols-3">
          <?php foreach ($testimoni as $t): ?>
            <figure class="reveal lift flex flex-col rounded-2xl bg-white p-7">
              <blockquote class="flex-1">"<?= e($t[2]) ?>"</blockquote>
              <figcaption class="mt-6 flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-full bg-emerald-soft font-display font-semibold text-emerald"><?= e($t[0]) ?></span>
                <span><span class="block font-medium"><?= e($t[1]) ?></span><span class="block text-sm text-ink">Donatur</span></span>
              </figcaption>
            </figure>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Form donasi -->
    <section id="donasi" class="mx-auto max-w-page px-5 py-20 sm:px-8 sm:py-28">
      <div class="mx-auto max-w-xl">
        <div class="reveal text-center">
          <h2 class="t-h2 font-display font-semibold">Formulir Donasi Kemanusiaan</h2>
          <p class="t-lead mt-4 text-ink">Isi formulir singkat di bawah ini.</p>
        </div>
        <form action="#" method="post" enctype="multipart/form-data" class="reveal mt-10 space-y-5 rounded-3xl border border-black/5 bg-white p-6 shadow-[0_20px_60px_-30px_rgba(27,33,30,.2)] sm:p-8">
          <div>
            <label for="nama" class="mb-1.5 block text-sm font-medium">Nama Donatur:</label>
            <input class="field" type="text" id="nama" name="nama" placeholder="Isi 'Hamba Allah' jika anonim">
          </div>
          <div>
            <label for="program" class="mb-1.5 block text-sm font-medium">Pilih Program Bantuan:</label>
            <select class="field" id="program" name="program">
              <?php foreach ($programs as $p): ?>
                <option value="<?= e($p->getId()) ?>"><?= e($p->getTitle()) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div>
            <label for="nominal" class="mb-1.5 block text-sm font-medium">Nominal Donasi (Rp):</label>
            <input class="field" type="number" id="nominal" name="nominal" min="1000" step="1000" placeholder="Contoh: 100000" required>
          </div>
          <div>
            <label for="doa" class="mb-1.5 block text-sm font-medium">Doa &amp; Pesan Kebaikan:</label>
            <textarea class="field" id="doa" name="doa" rows="3" placeholder="Tuliskan doa untuk warga Palestina..."></textarea>
          </div>
          <div>
            <label for="bukti" class="mb-1.5 block text-sm font-medium">Unggah Bukti Transfer:</label>
            <input class="field" type="file" id="bukti" name="bukti" accept="image/*">
          </div>
          <button type="submit" class="btn min-h-[52px] w-full rounded-full bg-emerald font-medium text-white hover:bg-emerald-dark">Kirim Donasi</button>
        </form>
      </div>
    </section>
  </main>

  <footer class="border-t border-black/5 bg-mist">
    <div class="mx-auto max-w-page px-5 py-10 text-center text-sm text-ink sm:px-8">
      <p>&copy; <?= date('Y') ?> <?= e($profil['nama']) ?> - Lembaga Penggalangan Dana Kemanusiaan Terpercaya</p>
    </div>
  </footer>

  <!-- Data dari PHP diteruskan ke JavaScript (panel detail) -->
  <script>
    const dataProgram = <?= json_encode($programs_by_id, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
  </script>

  <script>
    // Fade-in saat scroll
    const io = new IntersectionObserver((entries) => {
      entries.forEach(en => { if (en.isIntersecting) { en.target.classList.add('visible'); io.unobserve(en.target); } });
    }, { threshold: 0.12 });
    document.querySelectorAll('.reveal').forEach(el => io.observe(el));

    // Panel detail: tutup saat klik di luar panel atau setelah tombol donasi ditekan
    (function () {
      const panel = document.getElementById('detail-program');
      document.addEventListener('click', (e) => {
        if (panel.hidden) return;
        if (e.target.closest('#detail-donasi') || (!e.target.closest('#detail-program') && !e.target.closest('.btn-detail'))) {
          panel.hidden = true;
        }
      });
    })();
  </script>
</body>
</html>