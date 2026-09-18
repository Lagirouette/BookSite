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

    public function edit(int $id): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (empty($_SESSION['user']['id'])) {
            header('Location: /login');
            exit;
        }

        $bookManager = new GlobalBookManager();
        $book = $bookManager->findById($id);

        if ($book === null || $book->getUserId() !== (int) $_SESSION['user']['id']) {
            header('Location: /account');
            exit;
        }

        $error = null;
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $author = trim($_POST['author'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $status = $_POST['status'] ?? 'available';
            $status = in_array($status, ['available', 'unavailable'], true) ? $status : 'available';
            $image = $book->getImage();

            if ($title === '') {
                $error = 'Le titre du livre est obligatoire.';
            }

            if ($error === null && !empty($_FILES['image']['name'])) {
                $image = $this->storeBookImage($_FILES['image'], $error);
            }

            if ($error === null) {
                $bookManager->update(
                    $book->getId(),
                    $book->getUserId(),
                    $title,
                    $author,
                    $description,
                    $status,
                    $image
                );

                $book = $bookManager->findById($id);
                $success = 'Les informations du livre ont bien été modifiées.';
            }
        }

        require __DIR__ . '/../Views/books/edit.php';
    }

    public function deleteBook(int $id): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (empty($_SESSION['user']['id'])) {
            header('Location: /login');
            exit;
        }

        $bookManager = new GlobalBookManager();
        $book = $bookManager->findById($id);

        if ($book === null || $book->getUserId() !== (int) $_SESSION['user']['id']) {
            header('Location: /account');
            exit;
        }

        $bookManager->delete($book);
        header('Location: /account');
        exit;
    }

    private function storeBookImage(array $file, ?string &$error): ?string
    {
        if ($file['error'] !== UPLOAD_ERR_OK || $file['size'] > 2 * 1024 * 1024) {
            $error = 'L’image doit peser moins de 2 Mo.';
            return null;
        }

        $mime = (new \finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
        $extensions = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
        if (!isset($extensions[$mime])) {
            $error = 'L’image doit être au format JPG, PNG ou WEBP.';
            return null;
        }

        $filename = 'book-' . bin2hex(random_bytes(12)) . '.' . $extensions[$mime];
        $destination = __DIR__ . '/../../assets/images/' . $filename;
        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            $error = 'L’image n’a pas pu être enregistrée.';
            return null;
        }

        return '/assets/images/' . $filename;
    }
}