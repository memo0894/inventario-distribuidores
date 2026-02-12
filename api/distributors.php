<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/bootstrap.php';

header('Content-Type: application/json; charset=utf-8');

$q = trim((string) ($_GET['q'] ?? ''));
$items = repo()->all($q);

echo json_encode($items, JSON_UNESCAPED_UNICODE);
