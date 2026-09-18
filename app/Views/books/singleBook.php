<?php
    if (!isset($book)) {
        echo "Livre non trouvé.";
        exit;
    }
?>

<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= htmlspecialchars($book->getTitle(), ENT_QUOTES, 'UTF-8') ?> - TomTroc</title>
	<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
	<?php require __DIR__ . '/../partials/header.php'; ?>

	<main class="single-book">
		<div class="single-book__image">
			<?php if (!empty($book->getImage())): ?>
				<img src="<?= htmlspecialchars($book->getImage(), ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($book->getTitle(), ENT_QUOTES, 'UTF-8') ?>">
			<?php else: ?>
				<img src="/assets/images/default-book.jpg" alt="Image par défaut">
			<?php endif; ?>
		</div>

		<section class="single-book__details" aria-labelledby="book-title">
			<h1 id="book-title"><?= htmlspecialchars($book->getTitle(), ENT_QUOTES, 'UTF-8') ?></h1>
			<?php if (!empty($book->getAuthor())): ?>
				<p class="single-book__author">par <?= htmlspecialchars($book->getAuthor(), ENT_QUOTES, 'UTF-8') ?></p>
			<?php endif; ?>

			<div class="single-book__rule"></div>
			<h2>Description</h2>
			<p class="single-book__description">
				<?= nl2br(htmlspecialchars($book->getDescription() ?: 'Aucune description pour ce livre.', ENT_QUOTES, 'UTF-8')) ?>
			</p>

			<div class="single-book__owner">
				<h2>Propriétaire</h2>
				<?php if (isset($owner) && $owner): ?>
					<a class="single-book__owner-link" href="/users/<?= (int) $owner->getId() ?>">
						<img class="single-book__owner-avatar" src="<?= htmlspecialchars($owner->getProfilePhoto() ?: '/assets/images/avatar.png', ENT_QUOTES, 'UTF-8') ?>" alt="">
						<?= htmlspecialchars($owner->getUsername(), ENT_QUOTES, 'UTF-8') ?>
					</a>
				<?php else: ?>
					<p>
						<img class="single-book__owner-avatar" src="/assets/images/avatar.png" alt="">
						Membre TomTroc
					</p>
				<?php endif; ?>
			</div>

			<?php if (isset($owner) && $owner && (!isset($_SESSION['user']['id']) || (int) $_SESSION['user']['id'] !== $owner->getId())): ?>
				<a class="button single-book__message" href="/messages?with=<?= $owner->getId() ?>">Envoyer un message</a>
			<?php endif; ?>
		</section>
	</main>

	<?php require __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>