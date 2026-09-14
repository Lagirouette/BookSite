<?php
namespace App\Controllers;

use App\Models\User;
use UserManager;

class LoginController
{
    public function index(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $user = (new UserManager())->findByEmail($email);

            if ($user && password_verify($password, $user->getPassword())) {
                $_SESSION['user'] = [
                    'id' => $user->getId(),
                    'username' => $user->getUsername(),
                    'email' => $user->getEmail(),
                ];
                header('Location: /books');
                exit;
            }

            $error = 'Adresse email ou mot de passe incorrect.';
        }

        require __DIR__ . '/../Views/login/index.php';
    }
}
