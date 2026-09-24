<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars(isset($user) ? $user->getUsername() : 'Profil', ENT_QUOTES, 'UTF-8') ?> - TomTroc</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="public-account-page">
    <?php require __DIR__ . '/../partials/header.php'; ?>

    <main class="public-account-content page-shell">
        <section class="public-profile-card" aria-labelledby="public-profile-name">
            <img class="public-profile-photo" src="<?= htmlspecialchars(isset($user) ? ($user->getProfilePhoto() ?: '/assets/images/avatar.png') : '/assets/images/avatar.png', ENT_QUOTES, 'UTF-8') ?>" alt="Photo de profil de <?= htmlspecialchars(isset($user) ? $user->getUsername() : 'Profil', ENT_QUOTES, 'UTF-8') ?>">
            <hr>
            <h1 id="public-profile-name" class="public-profile-name"><?= htmlspecialchars(isset($user) ? $user->getUsername() : 'Profil', ENT_QUOTES, 'UTF-8') ?></h1>
            <p class="public-profile-meta">Membre depuis <?= date('Y', strtotime(isset($user) ? ($user->getCreatedAt() ?: 'now') : 'now')) ?></p>
            <p class="public-profile-books">Bibliothèque<br><?= count(isset($books) ? $books : []) ?> livre<?= count(isset($books) ? $books : []) > 1 ? 's' : '' ?></p>
            <?php if (!isset($_SESSION['user']['id']) || !isset($user) || (int) $_SESSION['user']['id'] !== (int) $user->getId()): ?>
                <a class="button" href="/messages?with=<?= isset($user) ? $user->getId() : 0 ?>">Écrire un message</a>
            <?php endif; ?>
        </section>

        <section class="account-books account-books--public" aria-labelledby="public-books-title">
            <h2 id="public-books-title" class="visually-hidden">Livres de <?= htmlspecialchars(isset($user) ? $user->getUsername() : 'Profil', ENT_QUOTES, 'UTF-8') ?></h2>
            <?php if (empty(isset($books) ? $books : [])): ?>
                <p class="empty-state">Cette bibliothèque ne contient pas encore de livre.</p>
            <?php else: ?>
                <div class="books-table-wrap">
                    <table class="books-table">
                        <thead>
                            <tr><th>Photo</th><th>Titre</th><th>Auteur</th><th>Description</th></tr>
                        </thead>
                        <tbody>
                        <?php foreach (isset($books) ? $books : [] as $book): ?>
                            <tr>
                                <td><img src="<?= htmlspecialchars($book->getImage() ?: '/assets/images/default-book.jpg', ENT_QUOTES, 'UTF-8') ?>" alt=""></td>
                                <td><?= htmlspecialchars($book->getTitle(), ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($book->getAuthor(), ENT_QUOTES, 'UTF-8') ?></td>
                                <td><span class="books-table-description"><?= htmlspecialchars($book->getDescription() ?: 'Aucune description', ENT_QUOTES, 'UTF-8') ?></span></td>
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