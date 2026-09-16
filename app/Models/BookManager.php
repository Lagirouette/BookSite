<?php

use App\Models\Book;
use Book as GlobalBook;

/**
 * Manager pour l'entité Book.
 */
class BookManager extends AbstractEntityManager
{
    /**
     * Récupère tous les livres de la base de données.
     */
    public function findAll(): array
    {
        $sql = 'SELECT * FROM books ORDER BY created_at DESC';
        $result = $this->db->query($sql);
        $books = [];

        while ($book = $result->fetch()) {
            $books[] = new GlobalBook($book);
        }

        return $books;
    }

    /**
     * Récupère un livre par son ID.
     */
    public function findById(int $id): ?GlobalBook
    {
        $sql = 'SELECT * FROM books WHERE id = :id LIMIT 1';
        $result = $this->db->query($sql, ['id' => $id]);
        $book = $result->fetch();

        return $book ? new GlobalBook($book) : null;
    }

    /**
     * Enregistre un livre dans la base de données.
     */
    // public function save(GlobalBook $book): void
    // {
    //     if ($book->getId() === 0) {
    //         $sql = 'INSERT INTO books (user_id, title, author, image, description, status, created_at) VALUES (:user_id, :title, :author, :image, :description, :status, NOW())';
    //         $this->db->query($sql, [
    //             'user_id' => $book->getUserId(),
    //             'title' => $book->getTitle(),
    //             'author' => $book->getAuthor(),
    //             'image' => $book->getImage(),
    //             'description' => $book->getDescription(),
    //             'status' => $book->getStatus(),
    //         ]);
    //         $book->setId((int)$this->db->lastInsertId());
    //     } else {
    //         $sql = 'UPDATE books SET user_id = :user_id, title = :title, author = :author, image = :image, description = :description, status = :status WHERE id = :id';
    //         $this->db->query($sql, [
    //             'id' => $book->getId(),
    //             'user_id' => $book->getUserId(),
    //             'title' => $book->getTitle(),
    //             'author' => $book->getAuthor(),
    //             'image' => $book->getImage(),
    //             'description' => $book->getDescription(),
    //             'status' => $book->getStatus(),
    //         ]);
    //     }
    // }

    /**
     * Supprime un livre de la base de données.
     */
    public function update(int $id, int $userId, string $title, ?string $author, ?string $description, string $status, string $image): void
    {
        $sql = 'UPDATE books SET user_id = :user_id, title = :title, author = :author, image = :image, description = :description, status = :status WHERE id = :id AND user_id = :user_id';
        $this->db->query($sql, [
            'id' => $id,
            'user_id' => $userId,
            'title' => $title,
            'author' => $author ?? '',
            'image' => $image,
            'description' => $description ?? '',
            'status' => $status,
        ]);
    }

    public function delete(GlobalBook $book): void
    {
        $sql = 'DELETE FROM books WHERE id = :id';
        $this->db->query($sql, ['id' => $book->getId()]);
    }

    /**
     * Récupère tous les livres d'un utilisateur spécifique.
     */
    public function findByUserId(int $userId): array
    {
        $sql = 'SELECT * FROM books WHERE user_id = :user_id ORDER BY created_at DESC';
        $result = $this->db->query($sql, ['user_id' => $userId]);
        $books = [];

        while ($book = $result->fetch()) {
            $books[] = new GlobalBook($book);
        }

        return $books;
    }

    /**
     * Récupèrer le nom de l'utilisateur qui a ajouté le livre.
     */
    public function getUserNameByBookId(int $bookId): ?string
    {
        $sql = 'SELECT u.username FROM users u JOIN books b ON u.id = b.user_id WHERE b.id = :book_id LIMIT 1';
        $result = $this->db->query($sql, ['book_id' => $bookId]);
        $user = $result->fetch();

        return $user ? $user['username'] : null;
    }
}