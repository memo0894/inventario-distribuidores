<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método no permitido');
}

try {
    $imagePath = handleImageUpload($_FILES['image'] ?? []);
    $data = normalizeDistributorData($_POST, $imagePath);

    if ($data['name'] === '') {
        throw new RuntimeException('El nombre es obligatorio.');
    }

    repo()->create($data);
    flash('Distribuidor creado correctamente.');
} catch (Throwable $e) {
    flash('Error: ' . $e->getMessage());
}

redirect('/');
