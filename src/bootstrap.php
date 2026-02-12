<?php

declare(strict_types=1);

use App\Database;
use App\DistributorRepository;

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/DistributorRepository.php';

function repo(): DistributorRepository
{
    static $repository = null;

    if ($repository === null) {
        $repository = new DistributorRepository(Database::connection());
    }

    return $repository;
}

function redirect(string $path): void
{
    header('Location: ' . $path);
    exit;
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function flash(string $message): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    $_SESSION['flash'] = $message;
}

function get_flash(): ?string
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (!isset($_SESSION['flash'])) {
        return null;
    }
    $message = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $message;
}

function normalizeDistributorData(array $source, ?string $imagePath): array
{
    return [
        'name' => trim((string) ($source['name'] ?? '')),
        'description' => trim((string) ($source['description'] ?? '')),
        'type' => trim((string) ($source['type'] ?? '')),
        'phone' => trim((string) ($source['phone'] ?? '')),
        'whatsapp' => trim((string) ($source['whatsapp'] ?? '')),
        'instagram' => trim((string) ($source['instagram'] ?? '')),
        'facebook' => trim((string) ($source['facebook'] ?? '')),
        'website' => trim((string) ($source['website'] ?? '')),
        'image_path' => $imagePath,
    ];
}

function handleImageUpload(array $file): ?string
{
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    if (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
        throw new RuntimeException('No se pudo subir la imagen.');
    }

    if (($file['size'] ?? 0) > 3 * 1024 * 1024) {
        throw new RuntimeException('La imagen supera los 3MB permitidos.');
    }

    $tmpPath = $file['tmp_name'] ?? '';
    $mime = mime_content_type($tmpPath);

    $allowed = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
    ];

    if (!isset($allowed[$mime])) {
        throw new RuntimeException('Formato inválido. Solo JPG, PNG o WEBP.');
    }

    $uploadsDir = __DIR__ . '/../uploads';
    if (!is_dir($uploadsDir)) {
        mkdir($uploadsDir, 0777, true);
    }

    $filename = bin2hex(random_bytes(16)) . '.' . $allowed[$mime];
    $destination = $uploadsDir . '/' . $filename;

    if (!move_uploaded_file($tmpPath, $destination)) {
        throw new RuntimeException('No se pudo guardar la imagen.');
    }

    return '/uploads/' . $filename;
}
