<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TomTroc - Modifier un livre</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="account-page">
    <?php require __DIR__ . '/../partials/header.php'; ?>

    <main class="page-shell book-edit-shell">
        <a class="book-edit-back" href="/account">retour</a>

        <h1>Modifier les informations</h1>

        <?php if ($error): ?><p class="form-error" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
        <?php if ($success): ?><p class="form-success" role="status"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>

        <section class="book-edit-card" aria-labelledby="book-edit-title">
            <div class="book-edit-media">
                <img src="<?= htmlspecialchars($book->getImage() ?: '/assets/images/default-book.jpg', ENT_QUOTES, 'UTF-8') ?>" alt="Couverture du livre <?= htmlspecialchars($book->getTitle(), ENT_QUOTES, 'UTF-8') ?>">
                <label class="book-edit-photo-link" for="image">Modifier la photo</label>
            </div>

            <form method="post" enctype="multipart/form-data" class="book-edit-form" id="book-edit-title">
                <input id="image" name="image" type="file" accept="image/jpeg,image/png,image/webp" class="visually-hidden">

                <label for="title">Titre</label>
                <input id="title" name="title" type="text" value="<?= htmlspecialchars($book->getTitle(), ENT_QUOTES, 'UTF-8') ?>" required>

                <label for="author">Auteur</label>
                <input id="author" name="author" type="text" value="<?= htmlspecialchars($book->getAuthor(), ENT_QUOTES, 'UTF-8') ?>">

                <label for="description">Commentaire</label>
                <textarea id="description" name="description"><?= htmlspecialchars($book->getDescription(), ENT_QUOTES, 'UTF-8') ?></textarea>

                <label for="status">Disponibilité</label>
                <select id="status" name="status">
                    <option value="available" <?= $book->getStatus() === 'available' ? 'selected' : '' ?>>Disponible</option>
                    <option value="unavailable" <?= $book->getStatus() === 'unavailable' ? 'selected' : '' ?>>Indisponible</option>
                </select>

                <button class="button" type="submit">Valider</button>
            </form>
        </section>
    </main>

    <?php require __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>
