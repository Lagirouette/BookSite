<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TomTroc - Connexion</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="auth-page">
    <?php require __DIR__ . '/../partials/header.php'; ?>
    <?php $error = $error ?? null; ?>

    <main class="auth-layout">
        <section class="auth-panel" aria-labelledby="login-title">
            <div class="auth-form-wrap">
                <p class="eyebrow">Bienvenue chez TomTroc</p>
                <h1 id="login-title">Connexion</h1>
                <p class="auth-intro">Retrouvez votre bibliothèque et vos échanges.</p>

                <?php if ($error): ?>
                    <p class="form-error" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>

                <form method="post" action="/login" class="auth-form">
                    <label for="email">Adresse email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

                    <label for="password">Mot de passe</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required>

                    <button class="button" type="submit">Se connecter</button>
                </form>

                <p class="auth-switch">Pas encore inscrit ? <a href="/register">Créer un compte</a></p>
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
