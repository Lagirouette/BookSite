<?php

/**
 * Classe Book : entité pure pour représenter un livre.
 */
class Book extends AbstractEntity
{
    private int $user_id = 0;
    private string $title = '';
    private string $author = '';
    private string $image = '';
    private string $description = '';
    private string $status = 'available';
    private string $created_at = '';

    public function setUserId(int $userId): void
    {
        $this->user_id = $userId;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setAuthor(?string $author): void
    {
        $this->author = $author ?? '';
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image ?? '';
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description ?? '';
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->created_at = $createdAt;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }
}
