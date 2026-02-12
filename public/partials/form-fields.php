<div class="col-md-6">
    <label class="form-label fw-semibold">Nombre *</label>
    <input name="name" class="form-control form-control-lg" required value="<?= e($data['name'] ?? '') ?>" placeholder="Ej: Distribuidora Central">
</div>
<div class="col-md-6">
    <label class="form-label fw-semibold">Tipo</label>
    <input name="type" class="form-control form-control-lg" value="<?= e($data['type'] ?? '') ?>" placeholder="Mayorista, Retail, Servicio...">
</div>
<div class="col-12">
    <label class="form-label fw-semibold">Descripción</label>
    <textarea name="description" class="form-control" rows="4" placeholder="Información breve, horarios, zonas de cobertura..."><?= e($data['description'] ?? '') ?></textarea>
</div>
<div class="col-md-6">
    <label class="form-label fw-semibold">Teléfono</label>
    <input name="phone" class="form-control" value="<?= e($data['phone'] ?? '') ?>" placeholder="+54 11 1234 5678">
</div>
<div class="col-md-6">
    <label class="form-label fw-semibold">WhatsApp</label>
    <input name="whatsapp" class="form-control" value="<?= e($data['whatsapp'] ?? '') ?>" placeholder="+54 11 1234 5678">
</div>
<div class="col-md-6">
    <label class="form-label fw-semibold">Instagram</label>
    <input name="instagram" class="form-control" value="<?= e($data['instagram'] ?? '') ?>" placeholder="@usuario">
</div>
<div class="col-md-6">
    <label class="form-label fw-semibold">Facebook</label>
    <input name="facebook" class="form-control" value="<?= e($data['facebook'] ?? '') ?>" placeholder="facebook.com/tupagina">
</div>
<div class="col-12">
    <label class="form-label fw-semibold">Website</label>
    <input name="website" class="form-control" value="<?= e($data['website'] ?? '') ?>" placeholder="https://tuweb.com">
</div>
<div class="col-12">
    <label class="form-label fw-semibold">Imagen (JPG/PNG/WEBP, máx 3MB)</label>
    <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
    <?php if (!empty($data['image_path'])): ?>
        <div class="mt-2">
            <img src="<?= e($data['image_path']) ?>" alt="Imagen actual" style="max-height: 140px;" class="img-thumbnail">
        </div>
    <?php endif; ?>
</div>
