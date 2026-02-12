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
    'image_path' => '',
];

$pageTitle = 'Directorio de Distribuidores | Inventario';
$headerTitle = 'Directorio de Distribuidores';
$headerSubtitle = 'Gestiona tus contactos y proveedores en un solo lugar';
$headerAction = ['label' => 'Volver al listado', 'href' => url('index.php')];

include __DIR__ . '/partials/layout-top.php';
?>

<section class="card border-0 shadow-sm">
    <div class="card-body p-3 p-md-4">
        <h2 class="h5 mb-3">Nuevo distribuidor</h2>
        <form method="post" action="<?= e(url('store.php')) ?>" enctype="multipart/form-data" class="row g-3">
            <?php include __DIR__ . '/partials/form-fields.php'; ?>
            <div class="col-12 d-flex flex-column flex-md-row gap-2 pt-2">
                <button type="submit" class="btn btn-primary btn-lg px-4">Guardar</button>
                <a href="<?= e(url('index.php')) ?>" class="btn btn-light border btn-lg px-4">Cancelar</a>
            </div>
        </form>
    </div>
</section>

<?php include __DIR__ . '/partials/layout-bottom.php'; ?>
