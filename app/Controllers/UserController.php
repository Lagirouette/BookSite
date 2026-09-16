<?php
namespace App\Controllers;

class UserController
{
    public function show(int $id): void
    {
        $userManager = new \UserManager();
        $bookManager = new \BookManager();
        $user = $userManager->findById($id);

        if (!$user) {
            $errorController = new ErrorController();
            $errorController->notFound();
            return;
        }

        $books = $bookManager->findByUserId($id);

        require __DIR__ . '/../Views/users/show.php';
    }
}