<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TomTroc - Accueil</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="home-page">
    <?php require __DIR__ . '/../partials/header.php'; ?>
    <?php $books = $books ?? []; ?>

    <main>
        <section class="home-hero section-cream">
            <div class="home-hero__content">
                <p class="eyebrow">La bibliothèque collaborative</p>
                <h1>Rejoignez nos<br>lecteurs passionnés</h1>
                <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.</p>
                <a class="button button--small" href="/books">Découvrir</a>
            </div>
            <figure class="home-hero__figure">
                <img src="https://images.unsplash.com/photo-1526243741027-444d633d7365?auto=format&fit=crop&w=900&q=85" alt="Lecteur entouré de livres dans une librairie">
            </figure>
        </section>

        <section class="latest-books section-white" aria-labelledby="latest-books-title">
            <div class="section-heading">
                <p class="eyebrow">La sélection de la communauté</p>
                <h2 id="latest-books-title">Les derniers livres ajoutés</h2>
            </div>
            <div class="book-grid">
                <?php foreach ($books as $book): ?>
                    <article class="book-card">
                        <img src="<?= htmlspecialchars($book['image'] ?? 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?auto=format&fit=crop&w=500&q=80', ENT_QUOTES, 'UTF-8') ?>" alt="Couverture de <?= htmlspecialchars($book['title'], ENT_QUOTES, 'UTF-8') ?>">
                        <div class="book-card__body">
                            <h3><?= htmlspecialchars($book['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                            <p><?= htmlspecialchars($book['author'] ?? 'Auteur inconnu', ENT_QUOTES, 'UTF-8') ?></p>
                            <small>Vendu par : membre TomTroc</small>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <a class="button button--small" href="/books">Voir tous les livres</a>
        </section>

        <section class="how-it-works section-cream" aria-labelledby="how-title">
            <div class="section-heading section-heading--narrow">
                <p class="eyebrow">Simple comme un échange</p>
                <h2 id="how-title">Comment ça marche ?</h2>
                <p>Échanger des livres avec TomTroc c'est simple et amusant ! Suivez ces étapes pour commencer :</p>
            </div>
            <div class="steps-grid">
                <article><span>01</span><p>Inscrivez-vous gratuitement sur notre plateforme.</p></article>
                <article><span>02</span><p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p></article>
                <article><span>03</span><p>Parcourez les livres disponibles chez d'autres membres.</p></article>
                <article><span>04</span><p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p></article>
            </div>
            <a class="button button--outline" href="/books">Voir tous les livres</a>
        </section>

        <section class="values section-white" aria-labelledby="values-title">
            <!-- <div class="values-banner"></div> -->
            <div class="values-content">
                <div>
                    <p class="eyebrow">Notre raison d'être</p>
                    <h2 id="values-title">Nos valeurs</h2>
                </div>
                <div class="values-copy">
                    <p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.</p>
                    <p>Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.</p>
                    <p>Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p>
                    <em>L'équipe Tom Troc</em>
                </div>
                <!-- <div class="values-mark" aria-hidden="true">♡</div> -->
            </div>
        </section>
    </main>

    <?php require __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>
