<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use PDOException;

class RegisterController extends Controller
{
    public function index(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $userModel = new User();

            if (mb_strlen($username) < 2) {
                $error = 'Le pseudo doit contenir au moins 2 caractères.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Veuillez saisir une adresse email valide.';
            } elseif (strlen($password) < 8) {
                $error = 'Le mot de passe doit contenir au moins 8 caractères.';
            } elseif ($userModel->findByEmail($email)) {
                $error = 'Cette adresse email est déjà utilisée.';
            } else {
                try {
                    $userId = $userModel->create($username, $email, $password);
                    $_SESSION['user'] = [
                        'id' => $userId,
                        'username' => $username,
                        'email' => $email,
                    ];
                    header('Location: /books');
                    exit;
                } catch (PDOException $exception) {
                    $error = 'Inscription impossible pour le moment.';
                }
            }
        }

        require __DIR__ . '/../Views/register/index.php';
    }
}