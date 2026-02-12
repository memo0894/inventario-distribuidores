<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/bootstrap.php';

$flashMessage = get_flash();
$distributors = repo()->all();
$pageTitle = 'Directorio de Distribuidores | Inventario';
$headerTitle = 'Directorio de Distribuidores';
$headerSubtitle = 'Gestiona tus contactos y proveedores en un solo lugar';
$headerAction = ['label' => '+ Nuevo', 'href' => url('create.php')];

include __DIR__ . '/partials/layout-top.php';
?>

<?php if ($flashMessage): ?>
    <div class="alert alert-success border-0 shadow-sm mb-4"><?= e($flashMessage) ?></div>
<?php endif; ?>

<section class="card border-0 shadow-sm mb-4">
    <div class="card-body p-3 p-md-4">
        <label for="search" class="form-label fw-semibold">Buscar distribuidores</label>
        <div class="position-relative">
            <span class="position-absolute top-50 start-0 translate-middle-y ps-3 text-secondary" aria-hidden="true">
                <svg class="icon-sm" viewBox="0 0 16 16" fill="currentColor"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85 1.06-1.06-3.85-3.85h-.001zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg>
            </span>
            <input id="search" class="form-control form-control-lg ps-5" type="search" placeholder="Buscar por nombre, tipo, redes, teléfono…">
        </div>
        <p id="resultCount" class="text-secondary small mb-0 mt-2"><?= count($distributors) ?> resultados</p>
    </div>
</section>

<section id="results" class="row g-3 g-md-4">
    <?php if (count($distributors) === 0): ?>
        <div class="col-12" id="emptyState">
            <div class="card border-0 shadow-sm text-center p-4 p-md-5">
                <div class="mb-3 text-primary">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/><path d="M12 8v8M8 12h8"/></svg>
                </div>
                <h2 class="h5 mb-2">Aún no tienes distribuidores registrados</h2>
                <p class="text-secondary mb-4">Empieza creando tu primer contacto para organizar tu directorio.</p>
                <a class="btn btn-primary btn-lg" href="<?= e(url('create.php')) ?>">Crear primer distribuidor</a>
            </div>
        </div>
    <?php else: ?>
        <?php foreach ($distributors as $item): ?>
            <?php
            $phone = trim((string) ($item['phone'] ?? ''));
            $whatsapp = trim((string) ($item['whatsapp'] ?? ''));
            $instagram = trim((string) ($item['instagram'] ?? ''));
            $website = trim((string) ($item['website'] ?? ''));
            $waLink = normalizePhoneForLink($whatsapp);
            ?>
            <div class="col-12 col-md-6 col-lg-4">
                <article class="card border-0 shadow-sm h-100">
                    <?php if (!empty($item['image_path'])): ?>
                        <img src="<?= e($item['image_path']) ?>" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Imagen de <?= e($item['name']) ?>">
                    <?php endif; ?>
                    <div class="card-body d-flex flex-column p-3 p-md-4">
                        <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                            <h2 class="h5 mb-0"><?= e($item['name']) ?></h2>
                            <?php if (!empty($item['type'])): ?>
                                <span class="badge text-bg-light border"><?= e($item['type']) ?></span>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($item['description'])): ?>
                            <p class="text-secondary small mb-3"><?= nl2br(e($item['description'])) ?></p>
                        <?php endif; ?>

                        <div class="small text-secondary mb-3 d-grid gap-1">
                            <?php if ($phone !== ''): ?><div><strong>Tel:</strong> <?= e($phone) ?></div><?php endif; ?>
                            <?php if ($whatsapp !== ''): ?><div><strong>WhatsApp:</strong> <?= e($whatsapp) ?></div><?php endif; ?>
                            <?php if ($instagram !== ''): ?><div><strong>Instagram:</strong> <?= e($instagram) ?></div><?php endif; ?>
                            <?php if ($website !== ''): ?><div><strong>Web:</strong> <?= e($website) ?></div><?php endif; ?>
                        </div>

                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <?php if ($waLink !== ''): ?>
                                <a class="btn btn-success btn-sm" target="_blank" rel="noopener noreferrer" href="https://wa.me/<?= e($waLink) ?>">WhatsApp</a>
                            <?php endif; ?>
                            <?php if ($phone !== ''): ?>
                                <a class="btn btn-outline-primary btn-sm" href="tel:<?= e(normalizePhoneForLink($phone)) ?>">Llamar</a>
                            <?php endif; ?>
                            <?php if ($instagram !== ''): ?>
                                <a class="btn btn-outline-dark btn-sm" target="_blank" rel="noopener noreferrer" href="https://instagram.com/<?= e(ltrim($instagram, '@')) ?>">
                                    <svg class="icon-xs" viewBox="0 0 16 16" fill="currentColor"><path d="M8 3.2A4.8 4.8 0 1 0 8 12.8 4.8 4.8 0 0 0 8 3.2Zm0 8A3.2 3.2 0 1 1 8 4.8a3.2 3.2 0 0 1 0 6.4Z"/><path d="M12.8 0H3.2A3.2 3.2 0 0 0 0 3.2v9.6A3.2 3.2 0 0 0 3.2 16h9.6a3.2 3.2 0 0 0 3.2-3.2V3.2A3.2 3.2 0 0 0 12.8 0Zm1.6 12.8a1.6 1.6 0 0 1-1.6 1.6H3.2a1.6 1.6 0 0 1-1.6-1.6V3.2A1.6 1.6 0 0 1 3.2 1.6h9.6a1.6 1.6 0 0 1 1.6 1.6v9.6Z"/><circle cx="12.2" cy="3.8" r="1"/></svg>
                                </a>
                            <?php endif; ?>
                            <?php if ($website !== ''): ?>
                                <a class="btn btn-outline-secondary btn-sm" target="_blank" rel="noopener noreferrer" href="<?= e($website) ?>">
                                    <svg class="icon-xs" viewBox="0 0 16 16" fill="currentColor"><path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0Zm6.4 7.2h-2.2a12.2 12.2 0 0 0-1-4A6.42 6.42 0 0 1 14.4 7.2ZM8 1.6c.8 0 2 1.8 2.5 5.6h-5C6 3.4 7.2 1.6 8 1.6Zm-3.2 1.6a12.2 12.2 0 0 0-1 4H1.6a6.42 6.42 0 0 1 3.2-4ZM1.6 8.8h2.2a12.2 12.2 0 0 0 1 4 6.42 6.42 0 0 1-3.2-4Zm6.4 5.6c-.8 0-2-1.8-2.5-5.6h5c-.5 3.8-1.7 5.6-2.5 5.6Zm3.2-1.6a12.2 12.2 0 0 0 1-4h2.2a6.42 6.42 0 0 1-3.2 4Z"/></svg>
                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex gap-2 mt-auto">
                            <a class="btn btn-outline-secondary w-100" href="<?= e(url('edit.php?id=' . (int) $item['id'])) ?>">Editar</a>
                            <form class="w-100" action="<?= e(url('delete.php')) ?>" method="post" onsubmit="return confirm('¿Eliminar este registro?');">
                                <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">
                                <button class="btn btn-outline-danger w-100" type="submit">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</section>

<script>
const results = document.getElementById('results');
const searchInput = document.getElementById('search');
const resultCount = document.getElementById('resultCount');
const baseUrl = <?= json_encode(url()) ?>;
let timeout;

function escapeHtml(value) {
    return String(value ?? '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function normalizePhone(value) {
    return String(value ?? '').replace(/\D+/g, '');
}

function getInstagramUrl(username) {
    const clean = String(username ?? '').trim().replace(/^@/, '');
    return clean ? `https://instagram.com/${encodeURIComponent(clean)}` : '';
}

function cardTemplate(item) {
    const safeName = escapeHtml(item.name);
    const typeBadge = item.type ? `<span class="badge text-bg-light border">${escapeHtml(item.type)}</span>` : '';
    const image = item.image_path
        ? `<img src="${encodeURI(item.image_path)}" class="card-img-top" style="height:180px;object-fit:cover;" alt="Imagen de ${safeName}">`
        : '';

    const phone = String(item.phone ?? '').trim();
    const whatsapp = String(item.whatsapp ?? '').trim();
    const instagram = String(item.instagram ?? '').trim();
    const website = String(item.website ?? '').trim();

    const info = [
        phone ? `<div><strong>Tel:</strong> ${escapeHtml(phone)}</div>` : '',
        whatsapp ? `<div><strong>WhatsApp:</strong> ${escapeHtml(whatsapp)}</div>` : '',
        instagram ? `<div><strong>Instagram:</strong> ${escapeHtml(instagram)}</div>` : '',
        website ? `<div><strong>Web:</strong> ${escapeHtml(website)}</div>` : ''
    ].join('');

    const quickButtons = [
        normalizePhone(whatsapp) ? `<a class="btn btn-success btn-sm" target="_blank" rel="noopener noreferrer" href="https://wa.me/${normalizePhone(whatsapp)}">WhatsApp</a>` : '',
        normalizePhone(phone) ? `<a class="btn btn-outline-primary btn-sm" href="tel:${normalizePhone(phone)}">Llamar</a>` : '',
        instagram ? `<a class="btn btn-outline-dark btn-sm" target="_blank" rel="noopener noreferrer" href="${getInstagramUrl(instagram)}"><svg class="icon-xs" viewBox="0 0 16 16" fill="currentColor"><path d="M8 3.2A4.8 4.8 0 1 0 8 12.8 4.8 4.8 0 0 0 8 3.2Zm0 8A3.2 3.2 0 1 1 8 4.8a3.2 3.2 0 0 1 0 6.4Z"/><path d="M12.8 0H3.2A3.2 3.2 0 0 0 0 3.2v9.6A3.2 3.2 0 0 0 3.2 16h9.6a3.2 3.2 0 0 0 3.2-3.2V3.2A3.2 3.2 0 0 0 12.8 0Zm1.6 12.8a1.6 1.6 0 0 1-1.6 1.6H3.2a1.6 1.6 0 0 1-1.6-1.6V3.2A1.6 1.6 0 0 1 3.2 1.6h9.6a1.6 1.6 0 0 1 1.6 1.6v9.6Z"/><circle cx="12.2" cy="3.8" r="1"/></svg></a>` : '',
        website ? `<a class="btn btn-outline-secondary btn-sm" target="_blank" rel="noopener noreferrer" href="${escapeHtml(website)}"><svg class="icon-xs" viewBox="0 0 16 16" fill="currentColor"><path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0Zm6.4 7.2h-2.2a12.2 12.2 0 0 0-1-4A6.42 6.42 0 0 1 14.4 7.2ZM8 1.6c.8 0 2 1.8 2.5 5.6h-5C6 3.4 7.2 1.6 8 1.6Zm-3.2 1.6a12.2 12.2 0 0 0-1 4H1.6a6.42 6.42 0 0 1 3.2-4ZM1.6 8.8h2.2a12.2 12.2 0 0 0 1 4 6.42 6.42 0 0 1-3.2-4Zm6.4 5.6c-.8 0-2-1.8-2.5-5.6h5c-.5 3.8-1.7 5.6-2.5 5.6Zm3.2-1.6a12.2 12.2 0 0 0 1-4h2.2a6.42 6.42 0 0 1-3.2 4Z"/></svg></a>` : ''
    ].join('');

    return `
    <div class="col-12 col-md-6 col-lg-4">
        <article class="card border-0 shadow-sm h-100">
            ${image}
            <div class="card-body d-flex flex-column p-3 p-md-4">
                <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                    <h2 class="h5 mb-0">${safeName}</h2>
                    ${typeBadge}
                </div>
                ${item.description ? `<p class="text-secondary small mb-3">${escapeHtml(item.description).replace(/\n/g, '<br>')}</p>` : ''}
                <div class="small text-secondary mb-3 d-grid gap-1">${info}</div>
                <div class="d-flex flex-wrap gap-2 mb-3">${quickButtons}</div>
                <div class="d-flex gap-2 mt-auto">
                    <a class="btn btn-outline-secondary w-100" href="${baseUrl}/edit.php?id=${item.id}">Editar</a>
                    <form class="w-100" action="${baseUrl}/delete.php" method="post" onsubmit="return confirm('¿Eliminar este registro?');">
                        <input type="hidden" name="id" value="${item.id}">
                        <button class="btn btn-outline-danger w-100" type="submit">Eliminar</button>
                    </form>
                </div>
            </div>
        </article>
    </div>`;
}

function emptyTemplate() {
    return `<div class="col-12" id="emptyState">
        <div class="card border-0 shadow-sm text-center p-4 p-md-5">
            <div class="mb-3 text-primary">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/><path d="M12 8v8M8 12h8"/></svg>
            </div>
            <h2 class="h5 mb-2">Sin resultados</h2>
            <p class="text-secondary mb-4">Prueba otro término o crea un nuevo distribuidor.</p>
            <a class="btn btn-primary btn-lg" href="${baseUrl}/create.php">Crear primer distribuidor</a>
        </div>
    </div>`;
}

function updateCounter(itemsLength, query) {
    if (!query) {
        resultCount.textContent = `${itemsLength} resultados`;
        return;
    }

    resultCount.textContent = itemsLength > 0 ? `${itemsLength} resultados` : 'Sin resultados';
}

function renderItems(items, query) {
    updateCounter(items.length, query);

    if (!items.length) {
        results.innerHTML = emptyTemplate();
        return;
    }

    results.innerHTML = items.map(cardTemplate).join('');
}

searchInput.addEventListener('input', () => {
    clearTimeout(timeout);
    timeout = setTimeout(async () => {
        const query = searchInput.value.trim();
        const q = encodeURIComponent(query);
        const response = await fetch(`${baseUrl}/api/distributors.php?q=${q}`);
        const data = await response.json();
        renderItems(data, query);
    }, 300);
});
</script>

<?php include __DIR__ . '/partials/layout-bottom.php'; ?>
