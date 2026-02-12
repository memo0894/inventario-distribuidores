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

try {
    $newImagePath = handleImageUpload($_FILES['image'] ?? []);
    $finalImagePath = $newImagePath ?? $item['image_path'];

    if ($newImagePath && !empty($item['image_path'])) {
        $oldFile = __DIR__ . '/..' . $item['image_path'];
        if (is_file($oldFile)) {
            unlink($oldFile);
        }
    }

    $data = normalizeDistributorData($_POST, $finalImagePath);

    if ($data['name'] === '') {
        throw new RuntimeException('El nombre es obligatorio.');
    }

    repo()->update($id, $data);
    flash('Distribuidor actualizado correctamente.');
} catch (Throwable $e) {
    flash('Error: ' . $e->getMessage());
}

redirect('/');
