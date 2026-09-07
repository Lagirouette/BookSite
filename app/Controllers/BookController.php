<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $bookModel = new Book();
        $books = $bookModel->findAll();

        require __DIR__ . '/../Views/books/index.php';
    }

    public function show(int $id)
    {
        $bookModel = new Book();
        $book = $bookModel->findById($id);

        require __DIR__ . '/../Views/books/show.php';
    }
}