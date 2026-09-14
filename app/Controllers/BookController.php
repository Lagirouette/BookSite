<?php
namespace App\Controllers;

use BookManager as GlobalBookManager;

class BookController
{
    public function index()
    {
        $bookManager = new GlobalBookManager();
        $books = $bookManager->findAll();
        $bookSellers = [];

        foreach ($books as $book) {
            $bookSellers[$book->getId()] = $bookManager->getUserNameByBookId($book->getId());
        }

        require __DIR__ . '/../Views/books/index.php';
    }

    public function show(int $id)
    {
        $bookManager = new GlobalBookManager();
        $book = $bookManager->findById($id);

        if ($book === null) {
            $errorController = new ErrorController();
            $errorController->notFound();
            return;
        }

        $userManager = new \UserManager();
        $owner = $userManager->findById($book->getUserId());

        require __DIR__ . '/../Views/books/singleBook.php';
    }
}