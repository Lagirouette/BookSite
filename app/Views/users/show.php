<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($user->getUsername(), ENT_QUOTES, 'UTF-8') ?> - TomTroc</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="public-account-page">
    <?php require __DIR__ . '/../partials/header.php'; ?>

    <main class="public-account-content page-shell">
        <section class="public-profile-card" aria-labelledby="public-profile-name">
            <img class="public-profile-photo" src="<?= htmlspecialchars($user->getProfilePhoto() ?: '/assets/images/avatar.png', ENT_QUOTES, 'UTF-8') ?>" alt="Photo de profil de <?= htmlspecialchars($user->getUsername(), ENT_QUOTES, 'UTF-8') ?>">
            <hr>
            <h1 id="public-profile-name" class="public-profile-name"><?= htmlspecialchars($user->getUsername(), ENT_QUOTES, 'UTF-8') ?></h1>
            <p class="public-profile-meta">Membre depuis <?= date('Y', strtotime($user->getCreatedAt() ?: 'now')) ?></p>
            <p class="public-profile-books">Bibliothèque<br><?= count($books) ?> livre<?= count($books) > 1 ? 's' : '' ?></p>
            <?php if (!isset($_SESSION['user']['id']) || (int) $_SESSION['user']['id'] !== $user->getId()): ?>
                <a class="button" href="/messages?with=<?= $user->getId() ?>">Écrire un message</a>
            <?php endif; ?>
        </section>

        <section class="account-books account-books--public" aria-labelledby="public-books-title">
            <h2 id="public-books-title" class="visually-hidden">Livres de <?= htmlspecialchars($user->getUsername(), ENT_QUOTES, 'UTF-8') ?></h2>
            <?php if (empty($books)): ?>
                <p class="empty-state">Cette bibliothèque ne contient pas encore de livre.</p>
            <?php else: ?>
                <div class="books-table-wrap">
                    <table class="books-table">
                        <thead>
                            <tr><th>Photo</th><th>Titre</th><th>Auteur</th><th>Description</th></tr>
                        </thead>
                        <tbody>
                        <?php foreach ($books as $book): ?>
                            <tr>
                                <td><img src="<?= htmlspecialchars($book->getImage() ?: '/assets/images/default-book.jpg', ENT_QUOTES, 'UTF-8') ?>" alt=""></td>
                                <td><?= htmlspecialchars($book->getTitle(), ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($book->getAuthor(), ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($book->getDescription() ?: 'Aucune description', ENT_QUOTES, 'UTF-8') ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <?php require __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>