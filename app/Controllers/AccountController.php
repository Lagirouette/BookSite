<?php
namespace App\Controllers;

use PDOException;

class AccountController
{
    public function index(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (empty($_SESSION['user']['id'])) {
            header('Location: /login');
            exit;
        }

        $userManager = new \UserManager();
        $bookManager = new \BookManager();
        $user = $userManager->findById((int) $_SESSION['user']['id']);
        $books = $bookManager->findByUserId((int) $_SESSION['user']['id']);
        $error = null;
        $success = null;

        if (!$user) {
            session_destroy();
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $profilePhoto = null;
            $profilePhotoMime = null;

            if (mb_strlen($username) < 2) {
                $error = 'Le pseudo doit contenir au moins 2 caractères.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Veuillez saisir une adresse email valide.';
            } elseif ($password !== '' && strlen($password) < 8) {
                $error = 'Le mot de passe doit contenir au moins 8 caractères.';
            } elseif (!empty($_FILES['profile_photo']['name'])) {
                [$profilePhoto, $profilePhotoMime] = $this->readProfilePhoto($_FILES['profile_photo'], $error);
            }

            if ($error === null) {
                try {
                    $userManager->updateProfile((int) $user->getId(), $username, $email, $password, $profilePhoto, $profilePhotoMime);
                    $_SESSION['user']['username'] = $username;
                    $_SESSION['user']['email'] = $email;
                    if ($profilePhoto !== null) {
                        $_SESSION['user']['profile_photo'] = '/profile-photo/' . $user->getId();
                    }
                    $user = $userManager->findById((int) $user->getId());
                    $success = 'Vos informations ont été enregistrées.';
                } catch (PDOException $exception) {
                    $error = 'La modification est impossible pour le moment.';
                }
            }
        }

        require __DIR__ . '/../Views/account/index.php';
    }

    private function readProfilePhoto(array $file, ?string &$error): array
    {
        if ($file['error'] !== UPLOAD_ERR_OK || $file['size'] > 2 * 1024 * 1024) {
            $error = 'La photo doit peser moins de 2 Mo.';
            return [null, null];
        }

        $mime = (new \finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
        $extensions = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
        if (!isset($extensions[$mime])) {
            $error = 'La photo doit être au format JPG, PNG ou WEBP.';
            return [null, null];
        }

        $contents = file_get_contents($file['tmp_name']);
        if ($contents === false) {
            $error = 'La photo n’a pas pu être enregistrée.';
            return [null, null];
        }

        return [$contents, $mime];
    }
}