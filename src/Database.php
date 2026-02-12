<?php

declare(strict_types=1);

namespace App;

use PDO;

final class Database
{
    private const DB_PATH = __DIR__ . '/../data/app.db';

    public static function connection(): PDO
    {
        $dataDir = dirname(self::DB_PATH);
        if (!is_dir($dataDir)) {
            mkdir($dataDir, 0777, true);
        }

        $pdo = new PDO('sqlite:' . self::DB_PATH);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        self::migrate($pdo);

        return $pdo;
    }

    private static function migrate(PDO $pdo): void
    {
        $pdo->exec(
            'CREATE TABLE IF NOT EXISTS distributors (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                description TEXT,
                type TEXT,
                phone TEXT,
                whatsapp TEXT,
                instagram TEXT,
                facebook TEXT,
                website TEXT,
                image_path TEXT,
                created_at TEXT NOT NULL,
                updated_at TEXT NOT NULL
            )'
        );
    }
}
