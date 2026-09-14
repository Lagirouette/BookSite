<?php
namespace App\Controllers;

use App\Core\Controller;
use BookManager as GlobalBookManager;

class BookController extends Controller
{
    public function index()
    {
        $bookManager = new GlobalBookManager();
        $books = $bookManager->findAll();

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