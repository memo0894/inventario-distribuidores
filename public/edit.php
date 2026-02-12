<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/bootstrap.php';

$id = (int) ($_GET['id'] ?? 0);
$item = repo()->find($id);

if (!$item) {
    http_response_code(404);
    echo 'Registro no encontrado';
    exit;
}

$data = $item;
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar distribuidor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h1 class="h3 mb-4">Editar distribuidor</h1>
    <form method="post" action="/update.php" enctype="multipart/form-data" class="card card-body shadow-sm">
        <input type="hidden" name="id" value="<?= (int) $data['id'] ?>">
        <?php include __DIR__ . '/partials/form-fields.php'; ?>
        <div class="mt-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="/" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
</body>
</html>
