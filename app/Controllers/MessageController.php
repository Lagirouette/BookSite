<?php
namespace App\Controllers;

class MessageController
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

        $currentUserId = (int) $_SESSION['user']['id'];
        $contactId = (int) ($_GET['with'] ?? 0);
        $messageManager = new \MessageManager();
        $userManager = new \UserManager();
        $conversations = $messageManager->findConversationUsers($currentUserId);

        $contact = $contactId > 0 ? $userManager->findById($contactId) : null;
        if ($contact && $contact->getId() === $currentUserId) {
            $contact = null;
            $contactId = 0;
        }

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = trim($_POST['content'] ?? '');
            $contactId = (int) ($_POST['receiver_id'] ?? 0);
            $contact = $contactId > 0 ? $userManager->findById($contactId) : null;

            if (!$contact || $contact->getId() === $currentUserId) {
                $error = 'Le destinataire sélectionné est invalide.';
            } elseif ($content === '') {
                $error = 'Le message ne peut pas être vide.';
            } else {
                $messageManager->create($currentUserId, $contactId, $content);
                header('Location: /messages?with=' . $contactId);
                exit;
            }
        }

        $messages = $contact ? $messageManager->findConversation($currentUserId, $contact->getId()) : [];
        require __DIR__ . '/../Views/messages/index.php';
    }
}