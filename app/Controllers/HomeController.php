<?php
namespace App\Controllers;

use BookManager;

class HomeController
{
    public function index(): void
    {
        $bookManager = new BookManager();
        $books = [];
        $bookSellers = [];

        try {
            $books = array_slice($bookManager->findAll(), 0, 4);
            foreach ($books as $book) {
                $bookSellers[$book->getId()] = $bookManager->getUserNameByBookId($book->getId());
            };
        } catch (\PDOException $exception) {
            $books = [];
        }

        if (empty($books)) {
            $books = [
                ['title' => 'Esther', 'author' => 'Alabaster', 'image' => '/assets/images/default-book.jpg'],
                ['title' => 'The Kinfolk Table', 'author' => 'Nathan Williams', 'image' => '/assets/images/default-book.jpg'],
                ['title' => 'Wabi Sabi', 'author' => 'Beth Kempton', 'image' => '/assets/images/default-book.jpg'],
                ['title' => 'Milk & honey', 'author' => 'Rupi Kaur', 'image' => '/assets/images/default-book.jpg'],
            ];
        }

        require __DIR__ . '/../Views/home/index.php';
    }
}
