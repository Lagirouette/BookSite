<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Liste des livres</title>
	<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="books-page">
	<?php require __DIR__ . '/../partials/header.php'; ?>
	<main class="page-shell books-content">
		<div class="books-toolbar">
			<h1>Nos livres à l'échanger</h1>
			<input type="text" id="searchInput" placeholder="Rechercher un livre..." onkeyup="filterBooks()">
		</div>

		<?php if (empty($books)): ?>
			<p>Aucun livre trouvé.</p>
		<?php else: ?>
			<div class="books-grid">
				<?php foreach ($books as $book): ?>
					<a class="book-item" href="/books/<?= $book->getId() ?>">
						<?php if (!empty($book->getImage())): ?>
							<img src="<?= htmlspecialchars($book->getImage(), ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($book->getTitle(), ENT_QUOTES, 'UTF-8') ?>">
						<?php else: ?>
							<img src="/assets/images/default-book.jpg" alt="Image par défaut">
						<?php endif; ?>

						<h2><?= htmlspecialchars($book->getTitle(), ENT_QUOTES, 'UTF-8') ?></h2>

						<?php if (!empty($bookSellers[$book->getId()])): ?>
							<p>Vendu par : <?= htmlspecialchars($bookSellers[$book->getId()], ENT_QUOTES, 'UTF-8') ?></p>
						<?php endif; ?>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</main>
	<script src="/assets/js/books.js"></script>

	<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>