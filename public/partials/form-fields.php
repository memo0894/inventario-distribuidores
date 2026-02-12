<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nombre *</label>
        <input name="name" class="form-control" required value="<?= e($data['name'] ?? '') ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Tipo</label>
        <input name="type" class="form-control" value="<?= e($data['type'] ?? '') ?>">
    </div>
    <div class="col-12">
        <label class="form-label">Descripción</label>
        <textarea name="description" class="form-control" rows="3"><?= e($data['description'] ?? '') ?></textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">Teléfono</label>
        <input name="phone" class="form-control" value="<?= e($data['phone'] ?? '') ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">WhatsApp</label>
        <input name="whatsapp" class="form-control" value="<?= e($data['whatsapp'] ?? '') ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Instagram</label>
        <input name="instagram" class="form-control" value="<?= e($data['instagram'] ?? '') ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Facebook</label>
        <input name="facebook" class="form-control" value="<?= e($data['facebook'] ?? '') ?>">
    </div>
    <div class="col-12">
        <label class="form-label">Website</label>
        <input name="website" class="form-control" value="<?= e($data['website'] ?? '') ?>">
    </div>
    <div class="col-12">
        <label class="form-label">Imagen (JPG/PNG/WEBP, máx 3MB)</label>
        <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
        <?php if (!empty($data['image_path'])): ?>
            <div class="mt-2">
                <img src="<?= e($data['image_path']) ?>" alt="Imagen actual" style="max-height: 120px;" class="img-thumbnail">
            </div>
        <?php endif; ?>
    </div>
</div>
