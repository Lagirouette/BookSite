<?php

/**
 * Entité User : uniquement les données de l'utilisateur.
 */
class User extends AbstractEntity
{
    private string $username = '';
    private string $email = '';
    private string $password = '';
    private string $profile_photo = '';
    private string $created_at = '';

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

    public function setProfilePhoto(?string $profilePhoto): void
    {
        $this->profile_photo = $profilePhoto ?? '';
    }

    public function getProfilePhoto(): string
    {
        return $this->profile_photo;
    }

    public function setCreatedAt(?string $createdAt): void
    {
        $this->created_at = $createdAt ?? '';
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }
}