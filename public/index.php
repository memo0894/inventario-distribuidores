<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/bootstrap.php';

$flashMessage = get_flash();
$distributors = repo()->all();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventario de Distribuidores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top { height: 200px; object-fit: cover; }
    </style>
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <h1 class="h3 m-0">Distribuidores / Locales</h1>
        <a class="btn btn-primary" href="/create.php">Nuevo distribuidor</a>
    </div>

    <?php if ($flashMessage): ?>
        <div class="alert alert-success"><?= e($flashMessage) ?></div>
    <?php endif; ?>

    <div class="mb-3">
        <label for="search" class="form-label">Buscar</label>
        <input id="search" class="form-control" type="search" placeholder="Nombre, tipo, redes, teléfono...">
    </div>

    <div id="results" class="row g-3">
        <?php foreach ($distributors as $item): ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <?php if (!empty($item['image_path'])): ?>
                        <img src="<?= e($item['image_path']) ?>" class="card-img-top" alt="Imagen de <?= e($item['name']) ?>">
                    <?php endif; ?>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= e($item['name']) ?></h5>
                        <p class="text-muted small mb-2"><?= e($item['type']) ?></p>
                        <p class="card-text"><?= nl2br(e($item['description'])) ?></p>
                        <ul class="list-unstyled small mb-3 mt-auto">
                            <li><strong>Tel:</strong> <?= e($item['phone']) ?></li>
                            <li><strong>WhatsApp:</strong> <?= e($item['whatsapp']) ?></li>
                            <li><strong>Instagram:</strong> <?= e($item['instagram']) ?></li>
                            <li><strong>Facebook:</strong> <?= e($item['facebook']) ?></li>
                            <li><strong>Web:</strong> <?= e($item['website']) ?></li>
                        </ul>
                        <div class="d-flex gap-2">
                            <a class="btn btn-outline-secondary btn-sm" href="/edit.php?id=<?= (int) $item['id'] ?>">Editar</a>
                            <form action="/delete.php" method="post" onsubmit="return confirm('¿Eliminar este registro?');">
                                <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">
                                <button class="btn btn-outline-danger btn-sm" type="submit">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
const results = document.getElementById('results');
const searchInput = document.getElementById('search');
let timeout;

function escapeHtml(value) {
    return String(value ?? '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/\"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function cardTemplate(item) {
    const safeName = escapeHtml(item.name);
    const image = item.image_path
        ? `<img src="${encodeURI(item.image_path)}" class="card-img-top" alt="Imagen de ${safeName}">`
        : '';

    return `
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm">
            ${image}
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">${safeName}</h5>
                <p class="text-muted small mb-2">${escapeHtml(item.type)}</p>
                <p class="card-text">${escapeHtml(item.description).replace(/\n/g, '<br>')}</p>
                <ul class="list-unstyled small mb-3 mt-auto">
                    <li><strong>Tel:</strong> ${escapeHtml(item.phone)}</li>
                    <li><strong>WhatsApp:</strong> ${escapeHtml(item.whatsapp)}</li>
                    <li><strong>Instagram:</strong> ${escapeHtml(item.instagram)}</li>
                    <li><strong>Facebook:</strong> ${escapeHtml(item.facebook)}</li>
                    <li><strong>Web:</strong> ${escapeHtml(item.website)}</li>
                </ul>
                <div class="d-flex gap-2">
                    <a class="btn btn-outline-secondary btn-sm" href="/edit.php?id=${item.id}">Editar</a>
                    <form action="/delete.php" method="post" onsubmit="return confirm('¿Eliminar este registro?');">
                        <input type="hidden" name="id" value="${item.id}">
                        <button class="btn btn-outline-danger btn-sm" type="submit">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>`;
}

function renderItems(items) {
    if (!items.length) {
        results.innerHTML = '<div class="col-12"><div class="alert alert-warning">No se encontraron resultados.</div></div>';
        return;
    }
    results.innerHTML = items.map(cardTemplate).join('');
}

searchInput.addEventListener('input', () => {
    clearTimeout(timeout);
    timeout = setTimeout(async () => {
        const q = encodeURIComponent(searchInput.value.trim());
        const response = await fetch(`/api/distributors.php?q=${q}`);
        const data = await response.json();
        renderItems(data);
    }, 250);
});
</script>
</body>
</html>
