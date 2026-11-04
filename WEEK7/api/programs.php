<?php
/* api/programs.php - endpoint JSON, diteruskan ke Controller */
require __DIR__ . '/../Controller/LembagaController.php';

(new LembagaController())->api();
