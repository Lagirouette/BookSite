<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page non trouvée - TomTroc</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="error-page">
    <?php require __DIR__ . '/../partials/header.php'; ?>

    <main class="error-content" aria-labelledby="error-title">
        <p class="error-code">Erreur 404</p>
        <h1 id="error-title">Page non trouvée</h1>
        <p>La page que vous recherchez n'existe pas ou n'est plus disponible.</p>
        <a class="button button--small" href="/">Retour à l'accueil</a>
    </main>

    <?php require __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>