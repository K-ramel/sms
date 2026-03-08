<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><?= SITENAME ?></a>
        <div class="d-flex">
            <?php if (isset($_SESSION['user'])): ?>
                <span class="text-white me-3">Welcome, <?= htmlspecialchars($_SESSION['user']['name']) ?> (<?= htmlspecialchars($_SESSION['user']['role']) ?>)</span>
                <a href="<?= URLROOT ?>/auth/logout" class="btn btn-outline-light btn-sm">Logout</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
