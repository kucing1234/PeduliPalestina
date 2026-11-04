<?php /* View/partials/header.php - kepala halaman + navigasi. Butuh: $judulHalaman, $basePath */ ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($judulHalaman) ?></title>
  <meta name="description" content="Salurkan donasi kemanusiaan untuk Palestina: bantuan medis, pangan, dan air bersih secara amanah dan transparan.">
  <link rel="icon" href="images/favicon.svg" type="image/svg+xml">
  <link rel="stylesheet" href="style.css">
  <script src="script.js" defer></script>
</head>
<body>
  <a class="skip-link" href="#main">Lewati ke konten utama</a>

  <header>
    <div class="logo">
      <a href="<?= e($basePath) ?>#hero"><img src="images/favicon.svg" alt="" width="32" height="32">Peduli<span>Palestina</span></a>
    </div>
    <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="menu" aria-label="Buka menu">
      <span></span><span></span><span></span>
    </button>
    <nav id="menu" aria-label="Navigasi utama">
      <ul>
        <li><a href="<?= e($basePath) ?>#hero">Beranda</a></li>
        <li><a href="<?= e($basePath) ?>#program-prioritas">Program Prioritas</a></li>
        <li><a href="<?= e($basePath) ?>#statistik">Statistik</a></li>
        <li><a href="<?= e($basePath) ?>#agenda">Agenda Penyaluran</a></li>
        <li><a href="<?= e($basePath) ?>#donasi" class="nav-cta">Donasi Sekarang</a></li>
      </ul>
    </nav>
  </header>
