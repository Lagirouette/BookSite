<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TomTroc - Mon compte</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="account-page">
    <?php require __DIR__ . '/../partials/header.php'; ?>

    <main class="account-content page-shell">
        <h1>Mon compte</h1>

        <?php if ($error): ?><p class="form-error" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
        <?php if ($success): ?><p class="form-success" role="status"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>

        <div class="account-panels">
            <section class="account-card account-profile" aria-labelledby="profile-title">
                <div class="profile-photo-wrap">
                    <img class="profile-photo" src="<?= htmlspecialchars($user->getProfilePhoto() ?: '/assets/images/avatar.png', ENT_QUOTES, 'UTF-8') ?>" alt="Photo de profil de <?= htmlspecialchars($user->getUsername(), ENT_QUOTES, 'UTF-8') ?>">
                    <label class="profile-photo-link" for="profile_photo">modifier</label>
                </div>
                <hr>
                <p class="profile-name"><?= htmlspecialchars($user->getUsername(), ENT_QUOTES, 'UTF-8') ?></p>
                <p class="profile-meta">Membre depuis <?= date('Y', strtotime($user->getCreatedAt() ?: 'now')) ?></p>
                <p class="profile-books"><?= count($books) ?> livres</p>
            </section>

            <section class="account-card account-form-card" aria-labelledby="profile-title">
                <h2 id="profile-title">Vos informations personnelles</h2>
                <form method="post" enctype="multipart/form-data" class="account-form">
                    <input id="profile_photo" name="profile_photo" type="file" accept="image/jpeg,image/png,image/webp" class="visually-hidden">
                    <label for="email">Adresse email</label>
                    <input id="email" name="email" type="email" required value="<?= htmlspecialchars($user->getEmail(), ENT_QUOTES, 'UTF-8') ?>">
                    <label for="password">Mot de passe</label>
                    <input id="password" name="password" type="password" minlength="8" autocomplete="new-password" placeholder="•••••••••">
                    <label for="username">Pseudo</label>
                    <input id="username" name="username" type="text" required value="<?= htmlspecialchars($user->getUsername(), ENT_QUOTES, 'UTF-8') ?>">
                    <button class="button button--outline" type="submit">Enregistrer</button>
                </form>
            </section>
        </div>

        <section class="account-books">
            <?php if (empty($books)): ?>
                <p class="empty-state">Vous n'avez pas encore ajouté de livre.</p>
            <?php else: ?>
                <div class="books-table-wrap">
                    <table class="books-table">
                        <thead><tr><th>Photo</th><th>Titre</th><th>Auteur</th><th>Description</th><th>Disponibilité</th><th>Action</th></tr></thead>
                        <tbody>
                        <?php foreach ($books as $book): ?>
                            <tr>
                                <td><img src="<?= htmlspecialchars($book->getImage() ?: '/assets/images/default-book.jpg', ENT_QUOTES, 'UTF-8') ?>" alt=""></td>
                                <td><?= htmlspecialchars($book->getTitle(), ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($book->getAuthor(), ENT_QUOTES, 'UTF-8') ?></td>
                                <td><span class="books-table-description"><?= htmlspecialchars($book->getDescription() ?: 'Aucune description', ENT_QUOTES, 'UTF-8') ?></span></td>
                                <td><span class="availability availability--<?= $book->getStatus() === 'available' ? 'available' : 'unavailable' ?>"><?= $book->getStatus() === 'available' ? 'Disponible' : 'Non dispo.' ?></span></td>
                                <td>
                                    <div class="books-table-actions">
                                        <a href="/books/<?= $book->getId() ?>/edit">Éditer</a>
                                        <a href="/books/<?= $book->getId() ?>/delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')">Supprimer</a>
                                    </div>
                                </td>
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