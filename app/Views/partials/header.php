<?php if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); } ?>
<header class="site-header">
    <a class="brand" href="/" aria-label="TomTroc, accueil">
        <img src="/assets/images/logo.png" alt="Logo de TomTroc">
    </a>

    <nav class="main-nav" aria-label="Navigation principale">
        <a href="/">Accueil</a>
        <a href="/books">Nos livres à l'échange</a>
    </nav>

    <div class="header-actions">
        <a href="<?= isset($_SESSION['user']) ? '/messages' : '/login' ?>" class="header-link header-link--messages">
            <img class="message-icon" src="/assets/images/text.png" alt="">
            <span>Messagerie</span>
        </a>
        <a href="<?= isset($_SESSION['user']) ? '/account' : '/login' ?>" class="header-link header-link--account">
            <img class="account-avatar" src="<?= htmlspecialchars($_SESSION['user']['profile_photo'] ?? '/assets/images/avatar.png', ENT_QUOTES, 'UTF-8') ?>" alt="">
            <span>Mon compte</span>
        </a>
        <?php if (isset($_SESSION['user'])): ?>
            <a href="/logout" class="header-link header-link--strong">Déconnexion</a>
        <?php else: ?>
            <a href="/login" class="header-link header-link--strong">Connexion</a>
        <?php endif; ?>
    </div>
</header>
