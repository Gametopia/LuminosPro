<?php
session_start();
?>

<?php
$currentPage = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
if ($currentPage === '') {
    $currentPage = 'home';
}
?>

<header>
    <div class="navbar" id="main-navbar">
        <div class="logo"><img src="/public/assets/img/lmns_short_star2.svg" alt="Luminos Logo"></div>
        <ul class="nav-links">
            <li><a href="/" class="<?= $currentPage === 'home' ? 'active' : '' ?>">Home</a></li>
            <li><a href="/about" class="<?= $currentPage === 'about' ? 'active' : '' ?>">Over Ons</a></li>
            <li><a href="/pricing" class="<?= $currentPage === 'pricing' ? 'active' : '' ?>">Tarieven</a></li>
            <li><a href="/store" class="<?= $currentPage === 'store' ? 'active' : '' ?>">Winkel</a></li>
            <li><a href="/contact" class="<?= $currentPage === 'contact' ? 'active' : '' ?>">Contact</a></li>
            <?php if (!empty($_SESSION['user'])): ?>

                <div class="nav-user">
                    <br>

                    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                        <a href="/admin/dashboard" class="btn btn-primary">Admin</a>
                    <?php elseif ($_SESSION['user']['role'] === 'customer'): ?>
                        <a href="/account" class="btn btn-primary">Account</a>
                    <?php endif; ?>

                    <a href="/logout" class="btn btn-secondary">Uitloggen</a>
                </div>

            <?php else: ?>

                <a href="/login" class="btn btn-secondary">Inloggen</a>

            <?php endif; ?>
        </ul>

        <a href="javascript:void(0);" class="icon" onclick="toggleNavbar()" aria-label="Open menu" role="button">
            <!-- Inline SVG hamburger to ensure visibility without Font Awesome -->
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg">
                <rect x="3" y="5" width="18" height="2" fill="currentColor" rx="1" />
                <rect x="3" y="11" width="18" height="2" fill="currentColor" rx="1" />
                <rect x="3" y="17" width="18" height="2" fill="currentColor" rx="1" />
            </svg>
        </a>
    </div>
</header>