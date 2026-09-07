<?php
namespace App\Models;

use PDO;

class Book
{
    private PDO $database;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/database.php';

        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            $config['host'],
            $config['dbname'],
            $config['charset']
        );

        $this->database = new PDO($dsn, $config['user'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    public function findAll(): array
    {
        $query = $this->database->query(
            'SELECT id, user_id, title, author, image, description, status, created_at
             FROM books
             ORDER BY created_at DESC'
        );

        return $query->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $query = $this->database->prepare(
            'SELECT id, user_id, title, author, image, description, status, created_at
             FROM books
             WHERE id = :id'
        );
        $query->execute(['id' => $id]);

        $book = $query->fetch();

        return $book ?: null;
    }
}
