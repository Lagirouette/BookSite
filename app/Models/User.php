<?php
namespace App\Models;

use PDO;

class User
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

    public function findByEmail(string $email): ?array
    {
        $query = $this->database->prepare(
            'SELECT id, username, email, password FROM users WHERE email = :email LIMIT 1'
        );
        $query->execute(['email' => $email]);

        $user = $query->fetch();
        return $user ?: null;
    }

    public function create(string $username, string $email, string $password): int
    {
        $query = $this->database->prepare(
            'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)'
        );
        $query->execute([
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        return (int) $this->database->lastInsertId();
    }
}
