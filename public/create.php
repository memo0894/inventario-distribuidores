<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/bootstrap.php';

$data = [
    'name' => '',
    'description' => '',
    'type' => '',
    'phone' => '',
    'whatsapp' => '',
    'instagram' => '',
    'facebook' => '',
    'website' => '',
];
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear distribuidor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h1 class="h3 mb-4">Nuevo distribuidor</h1>
    <form method="post" action="/store.php" enctype="multipart/form-data" class="card card-body shadow-sm">
        <?php include __DIR__ . '/partials/form-fields.php'; ?>
        <div class="mt-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="/" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
</body>
</html>
