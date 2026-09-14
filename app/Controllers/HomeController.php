<?php
namespace App\Controllers;

use BookManager;

class HomeController
{
    public function index(): void
    {
        $bookManager = new BookManager();
        $books = [];

        try {
            $books = array_slice($bookManager->findAll(), 0, 4);
        } catch (\PDOException $exception) {
            $books = [];
        }

        if (empty($books)) {
            $books = [
                ['title' => 'Esther', 'author' => 'Alabaster', 'image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&w=500&q=80'],
                ['title' => 'The Kinfolk Table', 'author' => 'Nathan Williams', 'image' => 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?auto=format&fit=crop&w=500&q=80'],
                ['title' => 'Wabi Sabi', 'author' => 'Beth Kempton', 'image' => 'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?auto=format&fit=crop&w=500&q=80'],
                ['title' => 'Milk & honey', 'author' => 'Rupi Kaur', 'image' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=500&q=80'],
            ];
        }

        require __DIR__ . '/../Views/home/index.php';
    }
}
