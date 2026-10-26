<?php
require __DIR__ . '/../data.php';

header('Content-Type: application/json; charset=utf-8');
echo json_encode(
    array_map(fn($p) => $p->toArray(), $programs),
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);