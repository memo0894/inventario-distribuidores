<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método no permitido');
}

$id = (int) ($_POST['id'] ?? 0);
$item = repo()->find($id);

if (!$item) {
    flash('Registro no encontrado.');
    redirect('/');
}

repo()->delete($id);

if (!empty($item['image_path'])) {
    $path = __DIR__ . '/..' . $item['image_path'];
    if (is_file($path)) {
        unlink($path);
    }
}

flash('Distribuidor eliminado.');
redirect('/');
