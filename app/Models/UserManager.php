<?php

/**
 * Classe UserManager pour gérer les requêtes liées aux users et à l'authentification.
 */
class UserManager extends AbstractEntityManager
{
    /**
     * Récupère un utilisateur par son identifiant.
     */
    public function findById(int $id): ?User
    {
        $sql = 'SELECT id, username, email FROM users WHERE id = :id LIMIT 1';
        $result = $this->db->query($sql, ['id' => $id]);
        $user = $result->fetch();

        return $user ? new User($user) : null;
    }

    /**
     * Récupère un utilisateur par son pseudo.
     */
    public function getUserByUsername(string $username): ?User
    {
        $sql = 'SELECT * FROM users WHERE username = :username LIMIT 1';
        $result = $this->db->query($sql, ['username' => $username]);
        $user = $result->fetch();

        return $user ? new User($user) : null;
    }

    /**
     * Récupère un utilisateur par son email.
     */
    public function findByEmail(string $email): ?User
    {
        $sql = 'SELECT id, username, email, password FROM users WHERE email = :email LIMIT 1';
        $result = $this->db->query($sql, ['email' => $email]);
        $user = $result->fetch();

        return $user ? new User($user) : null;
    }

    /**
     * Crée un nouvel utilisateur.
     */
    public function create(string $username, string $email, string $password): int
    {
        $sql = 'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)';
        $this->db->query($sql, [
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        return (int) $this->db->getPDO()->lastInsertId();
    }
}