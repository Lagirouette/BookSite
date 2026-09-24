<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
$contactId = isset($contactId) ? (int) $contactId : 0;
$contact = $contact ?? null;
$messages = $messages ?? [];
$error = $error ?? null;
$currentUserId = isset($currentUserId) ? (int) $currentUserId : (int) ($_SESSION['user_id'] ?? 0);
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Messagerie - TomTroc</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="messages-page">
    <?php require __DIR__ . '/../partials/header.php'; ?>

    <main class="messages-layout <?= $contact ? 'messages-layout--conversation' : 'messages-layout--list' ?>">
        <aside class="conversation-list" aria-labelledby="messages-title">
            <h1 id="messages-title">Messagerie</h1>
            <?php if (empty($conversations)): ?>
                <p class="messages-empty">Aucune conversation.</p>
            <?php else: ?>
                <?php foreach ($conversations as $conversation): ?>
                    <a class="conversation-item <?= (int) $conversation['id'] === $contactId ? 'conversation-item--active' : '' ?>" href="/messages?with=<?= (int) $conversation['id'] ?>">
                        <img src="<?= htmlspecialchars($conversation['profile_photo_mime'] ? '/profile-photo/' . (int) $conversation['id'] : '/assets/images/avatar.png', ENT_QUOTES, 'UTF-8') ?>" alt="">
                        <span class="conversation-item__details">
                            <span class="conversation-item__topline">
                                <strong><?= htmlspecialchars($conversation['username'], ENT_QUOTES, 'UTF-8') ?></strong>
                                <small><?= date('d/m/Y H:i', strtotime($conversation['last_message_at'])) ?></small>
                            </span>
                            <span class="conversation-item__preview"><?= htmlspecialchars($conversation['last_message'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
                        </span>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </aside>

        <section class="conversation" aria-labelledby="conversation-title">
            <?php if ($contact): ?>
            <a class="conversation__back" href="/messages">&lt; retour</a>
                <header class="conversation__header">
                    <img src="<?= htmlspecialchars($contact->getProfilePhoto() ?: '/assets/images/avatar.png', ENT_QUOTES, 'UTF-8') ?>" alt="">
                    <h2 id="conversation-title"><?= htmlspecialchars($contact->getUsername(), ENT_QUOTES, 'UTF-8') ?></h2>
                </header>
                <div class="conversation__messages">
                    <?php foreach ($messages as $message): ?>
                        <article class="message <?= (int) $message['sender_id'] === $currentUserId ? 'message--sent' : 'message--received' ?>">
                            <div class="message__meta">
                                <?php if ((int) $message['sender_id'] !== $currentUserId): ?>
                                    <img class="message__avatar" src="<?= htmlspecialchars($contact->getProfilePhoto() ?: '/assets/images/avatar.png', ENT_QUOTES, 'UTF-8') ?>" alt="">
                                <?php endif; ?>
                                <time datetime="<?= htmlspecialchars($message['created_at'], ENT_QUOTES, 'UTF-8') ?>"><?= date('d/m H:i', strtotime($message['created_at'])) ?></time>
                            </div>
                            <p><?= nl2br(htmlspecialchars($message['content'], ENT_QUOTES, 'UTF-8')) ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
                <?php if ($error): ?><p class="form-error" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
                <form class="message-form" method="post">
                    <input type="hidden" name="receiver_id" value="<?= isset($contact) ? $contact->getId() : 0 ?>">
                    <label class="visually-hidden" for="content">Votre message</label>
                    <textarea id="content" name="content" rows="1" required placeholder="Tapez votre message ici"></textarea>
                    <button class="button" type="submit">Envoyer</button>
                </form>
            <?php else: ?>
                <div class="conversation__placeholder">
                    <p id="conversation-placeholder-title">Sélectionnez une conversation pour consulter vos messages.</p>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <?php require __DIR__ . '/../partials/footer.php'; ?>
    <script src="/assets/js/messages.js"></script>
</body>
</html>