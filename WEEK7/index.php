<?php
/* =========================================================
   index.php - pintu masuk aplikasi (front controller)
   Hanya menerima request dan meneruskannya ke Controller.
     index.php                       -> LembagaController::index()
     index.php?aksi=show&id=medis    -> LembagaController::show('medis')
     POST index.php?aksi=process     -> LembagaController::process()
   ========================================================= */
require __DIR__ . '/Controller/LembagaController.php';

$controller = new LembagaController();
$aksi = $_GET['aksi'] ?? 'index';

if ($aksi === 'process' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->process();
} elseif ($aksi === 'show') {
    $controller->show((string) ($_GET['id'] ?? ''));
} else {
    $controller->index();
}
