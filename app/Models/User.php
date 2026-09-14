<?php

/**
 * Entité User : uniquement les données de l'utilisateur.
 */
class User extends AbstractEntity
{
    private string $username = '';
    private string $email = '';
    private string $password = '';

    /**
     * Compatibilité avec l'ancien nom login.
     */
    public function setLogin(string $login): void
    {
        $this->username = $login;
    }

    public function getLogin(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}