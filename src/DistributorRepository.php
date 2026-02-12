<?php

declare(strict_types=1);

namespace App;

use PDO;

final class DistributorRepository
{
    public function __construct(private readonly PDO $pdo)
    {
    }

    public function all(?string $search = null): array
    {
        if ($search === null || $search === '') {
            $stmt = $this->pdo->query('SELECT * FROM distributors ORDER BY updated_at DESC');
            return $stmt->fetchAll();
        }

        $stmt = $this->pdo->prepare(
            'SELECT * FROM distributors
             WHERE name LIKE :search
                OR description LIKE :search
                OR type LIKE :search
                OR phone LIKE :search
                OR whatsapp LIKE :search
                OR instagram LIKE :search
                OR facebook LIKE :search
                OR website LIKE :search
             ORDER BY updated_at DESC'
        );
        $stmt->execute(['search' => '%' . $search . '%']);
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM distributors WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $item = $stmt->fetch();
        return $item ?: null;
    }

    public function create(array $data): int
    {
        $now = date('c');
        $stmt = $this->pdo->prepare(
            'INSERT INTO distributors
             (name, description, type, phone, whatsapp, instagram, facebook, website, image_path, created_at, updated_at)
             VALUES
             (:name, :description, :type, :phone, :whatsapp, :instagram, :facebook, :website, :image_path, :created_at, :updated_at)'
        );

        $stmt->execute([
            'name' => $data['name'],
            'description' => $data['description'],
            'type' => $data['type'],
            'phone' => $data['phone'],
            'whatsapp' => $data['whatsapp'],
            'instagram' => $data['instagram'],
            'facebook' => $data['facebook'],
            'website' => $data['website'],
            'image_path' => $data['image_path'],
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->pdo->prepare(
            'UPDATE distributors
             SET name = :name,
                 description = :description,
                 type = :type,
                 phone = :phone,
                 whatsapp = :whatsapp,
                 instagram = :instagram,
                 facebook = :facebook,
                 website = :website,
                 image_path = :image_path,
                 updated_at = :updated_at
             WHERE id = :id'
        );

        $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'description' => $data['description'],
            'type' => $data['type'],
            'phone' => $data['phone'],
            'whatsapp' => $data['whatsapp'],
            'instagram' => $data['instagram'],
            'facebook' => $data['facebook'],
            'website' => $data['website'],
            'image_path' => $data['image_path'],
            'updated_at' => date('c'),
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM distributors WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}
