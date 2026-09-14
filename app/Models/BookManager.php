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
}