<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TomTroc - Inscription</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="auth-page">
    <?php require __DIR__ . '/../partials/header.php'; ?>
    <?php $error = $error ?? null; ?>

    <main class="auth-layout">
        <section class="auth-panel" aria-labelledby="register-title">
            <div class="auth-form-wrap">
                <h1 class="register-title">Inscription</h1>

                <?php if ($error): ?>
                    <p class="form-error" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>

                <form method="post" action="/register" class="auth-form">
                    <label for="username">Pseudo</label>
                    <input id="username" name="username" type="text" autocomplete="username" required value="<?= htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

                    <label for="email">Adresse email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

                    <label for="password">Mot de passe</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" minlength="8" required>

                    <button class="button" type="submit">S'inscrire</button>
                </form>

                <p class="auth-switch">Déjà inscrit ? <a href="/login">Connectez-vous</a></p>
            </div>
        </section>
        <div class="auth-image" role="img" aria-label="Bibliothèque remplie de livres"></div>
    </main>

    <footer class="site-footer">
        <a href="#">Politique de confidentialité</a>
        <a href="#">Mentions légales</a>
        <span>TomTroc©</span>
        <strong>TT</strong>
    </footer>
</body>
</html>