<?php
/* View/program-detail.php - halaman detail satu program.
   Data dari Controller::show(): $program (object Program), $namaLembaga */
$persen = $program->persen();
list($label, $kelas) = $program->status();
require __DIR__ . '/partials/header.php';
?>

  <main id="main">
    <section id="detail-halaman" class="halaman-detail">
      <p><a href="index.php#program-prioritas">&larr; Kembali ke daftar program</a></p>
      <img src="images/<?= e($program->getId()) ?>.svg" alt="<?= e($program->getTitle()) ?>" width="640" height="360">
      <span class="badge badge-<?= e($kelas) ?>"><?= e($label) ?> &middot; <?= $persen ?>%</span>
      <h1><?= e($program->getTitle()) ?></h1>
      <p><?= e($program->getDescription()) ?></p>
      <p><strong>Kategori:</strong> <?= e($program->getCategory()) ?></p>
      <progress max="100" value="<?= $persen ?>"></progress>
      <p><?= e(rupiah($program->getTerkumpul())) ?> dari <?= e(rupiah($program->getTarget())) ?> (<?= $persen ?>%)</p>
      <a class="btn" href="index.php?program=<?= e($program->getId()) ?>#donasi">Donasi untuk program ini</a>
    </section>
  </main>

<?php require __DIR__ . '/partials/footer.php'; ?>

</body>
</html>
