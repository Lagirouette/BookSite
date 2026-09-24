<?php if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); } ?>
<?php
$unreadMessageCount = 0;
if (isset($_SESSION['user']['id'])) {
    $messageManager = new \MessageManager();
    $unreadMessageCount = $messageManager->countUnread((int) $_SESSION['user']['id']);
}
?>
<header class="site-header">
    <div class="header-top">
        <a class="brand" href="/" aria-label="TomTroc, accueil">
            <img src="/assets/images/logo.png" alt="Logo de TomTroc">
        </a>

        <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="main-navigation">
            <span></span>
            <span></span>
            <span></span>
            <span class="visually-hidden">Ouvrir le menu</span>
        </button>

        <nav class="main-nav" id="main-navigation" aria-label="Navigation principale">
            <a href="/">Accueil</a>
            <a href="/books">Nos livres à l'échange</a>
            <div class="header-actions">
                <a href="<?= isset($_SESSION['user']) ? '/messages' : '/login' ?>" class="header-link header-link--messages">
                    <img class="message-icon" src="/assets/images/text.png" alt="">
                    <span>Messagerie</span>
                    <?php if ($unreadMessageCount > 0): ?>
                        <span class="message-count" aria-label="<?= $unreadMessageCount ?> message<?= $unreadMessageCount > 1 ? 's' : '' ?> non lu<?= $unreadMessageCount > 1 ? 's' : '' ?>"><?= $unreadMessageCount > 99 ? '99+' : $unreadMessageCount ?></span>
                    <?php endif; ?>
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
        </nav>
    </div>
</header>
<script src="/assets/js/menu.js"></script>
