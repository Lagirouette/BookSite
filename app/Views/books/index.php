<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Liste des livres</title>
	<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
	<?php require __DIR__ . '/../partials/header.php'; ?>
	<main class="page-shell books-content">
	<h1>Les livres à l'échange</h1>

	<?php if (empty($books)): ?>
		<p>Aucun livre trouvé.</p>
	<?php else: ?>
		<?php foreach ($books as $book): ?>
			<article>
				<h2><?= htmlspecialchars($book['title'], ENT_QUOTES, 'UTF-8') ?></h2>

				<?php if (!empty($book['author'])): ?>
					<p>Auteur : <?= htmlspecialchars($book['author'], ENT_QUOTES, 'UTF-8') ?></p>
				<?php endif; ?>

				<?php if (!empty($book['description'])): ?>
					<p><?= nl2br(htmlspecialchars($book['description'], ENT_QUOTES, 'UTF-8')) ?></p>
				<?php endif; ?>

				<p>Statut : <?= htmlspecialchars($book['status'], ENT_QUOTES, 'UTF-8') ?></p>
			</article>
		<?php endforeach; ?>
	<?php endif; ?>
	</main>
</body>
</html>