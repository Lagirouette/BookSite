<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
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

    <main class="messages-layout">
        <aside class="conversation-list" aria-labelledby="messages-title">
            <h1 id="messages-title">Messagerie</h1>
            <?php if (empty($conversations)): ?>
                <p class="messages-empty">Aucune conversation.</p>
            <?php else: ?>
                <?php foreach ($conversations as $conversation): ?>
                    <a class="conversation-item <?= (int) $conversation['id'] === $contactId ? 'conversation-item--active' : '' ?>" href="/messages?with=<?= (int) $conversation['id'] ?>">
                        <img src="<?= htmlspecialchars($conversation['profile_photo'] ?: '/assets/images/avatar.png', ENT_QUOTES, 'UTF-8') ?>" alt="">
                        <span class="conversation-item__details">
                            <strong><?= htmlspecialchars($conversation['username'], ENT_QUOTES, 'UTF-8') ?></strong>
                            <small><?= date('d/m/Y H:i', strtotime($conversation['last_message_at'])) ?></small>
                        </span>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </aside>

        <section class="conversation" aria-labelledby="conversation-title">
            <?php if ($contact): ?>
                <header class="conversation__header">
                    <img src="<?= htmlspecialchars($contact->getProfilePhoto() ?: '/assets/images/avatar.png', ENT_QUOTES, 'UTF-8') ?>" alt="">
                    <h2 id="conversation-title"><?= htmlspecialchars($contact->getUsername(), ENT_QUOTES, 'UTF-8') ?></h2>
                </header>
                <div class="conversation__messages">
                    <?php foreach ($messages as $message): ?>
                        <article class="message <?= (int) $message['sender_id'] === $currentUserId ? 'message--sent' : 'message--received' ?>">
                            <time datetime="<?= htmlspecialchars($message['created_at'], ENT_QUOTES, 'UTF-8') ?>"><?= date('d/m H:i', strtotime($message['created_at'])) ?></time>
                            <p><?= nl2br(htmlspecialchars($message['content'], ENT_QUOTES, 'UTF-8')) ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
                <?php if ($error): ?><p class="form-error" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
                <form class="message-form" method="post">
                    <input type="hidden" name="receiver_id" value="<?= $contact->getId() ?>">
                    <label class="visually-hidden" for="content">Votre message</label>
                    <textarea id="content" name="content" rows="1" required placeholder="Votre message..."></textarea>
                    <button class="button" type="submit">Envoyer</button>
                </form>
            <?php else: ?>
                <div class="conversation__placeholder">
                    <p>Sélectionnez une conversation pour consulter vos messages.</p>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <?php require __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>