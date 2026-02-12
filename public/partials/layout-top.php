<?php
/** @var string $pageTitle */
/** @var string $headerTitle */
/** @var string $headerSubtitle */
/** @var array<string,string>|null $headerAction */
$pageTitle = $pageTitle ?? 'Directorio de Distribuidores | Inventario';
$headerTitle = $headerTitle ?? 'Directorio de Distribuidores';
$headerSubtitle = $headerSubtitle ?? 'Gestiona tus contactos y proveedores en un solo lugar';
$headerAction = $headerAction ?? ['label' => '+ Nuevo', 'href' => url('create.php')];
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --surface: #f3f6fb; --text-muted: #6c7a89; }
        body { background: linear-gradient(180deg, #f8fafc 0%, var(--surface) 100%); }
        .dashboard-shell { max-width: 1100px; }
        .sticky-top-soft { position: sticky; top: 0; z-index: 1030; backdrop-filter: blur(8px); background-color: rgba(248, 250, 252, .9); border-bottom: 1px solid #e9edf3; }
        .icon-xs { width: 14px; height: 14px; }
        .icon-sm { width: 16px; height: 16px; }
    </style>
</head>
<body>
<header class="sticky-top-soft">
    <div class="container dashboard-shell py-3 px-3 px-md-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h1 class="h4 h3-md mb-1 fw-semibold"><?= e($headerTitle) ?></h1>
                <p class="text-secondary mb-0 small"><?= e($headerSubtitle) ?></p>
            </div>
            <?php if (!empty($headerAction['href']) && !empty($headerAction['label'])): ?>
                <a href="<?= e($headerAction['href']) ?>" class="btn btn-primary btn-lg px-4 w-100 w-md-auto"><?= e($headerAction['label']) ?></a>
            <?php endif; ?>
        </div>
    </div>
</header>
<main class="container dashboard-shell px-3 px-md-4 py-4 py-md-5">
