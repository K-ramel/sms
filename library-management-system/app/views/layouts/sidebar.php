<div class="list-group mb-4">
    <?php $role = $_SESSION['user']['role'] ?? ''; ?>
    <?php if ($role === 'admin'): ?>
        <a class="list-group-item list-group-item-action" href="<?= URLROOT ?>/admin/dashboard">Dashboard</a>
        <a class="list-group-item list-group-item-action" href="<?= URLROOT ?>/book/index">Books</a>
        <a class="list-group-item list-group-item-action" href="<?= URLROOT ?>/user/index">Users</a>
        <a class="list-group-item list-group-item-action" href="<?= URLROOT ?>/report/index">Reports</a>
        <a class="list-group-item list-group-item-action" href="<?= URLROOT ?>/admin/auditLogs">Audit Logs</a>
    <?php elseif ($role === 'librarian'): ?>
        <a class="list-group-item list-group-item-action" href="<?= URLROOT ?>/librarian/dashboard">Dashboard</a>
    <?php else: ?>
        <a class="list-group-item list-group-item-action" href="<?= URLROOT ?>/library/dashboard">Dashboard</a>
        <a class="list-group-item list-group-item-action" href="<?= URLROOT ?>/library/search">Search Books</a>
        <a class="list-group-item list-group-item-action" href="<?= URLROOT ?>/library/borrowed">Borrowed Books</a>
    <?php endif; ?>
</div>
