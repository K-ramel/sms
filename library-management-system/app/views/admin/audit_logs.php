<?php require APPROOT . '/app/views/layouts/header.php'; require APPROOT . '/app/views/layouts/navbar.php'; ?>
<div class="container-fluid py-4"><div class="row"><div class="col-md-2"><?php require APPROOT . '/app/views/layouts/sidebar.php'; ?></div>
<div class="col-md-10">
<h3>Audit Logs</h3>
<table class="table table-bordered"><thead><tr><th>ID</th><th>User</th><th>Action</th><th>When</th></tr></thead><tbody>
<?php foreach ($logs as $log): ?>
<tr><td><?= $log['id'] ?></td><td><?= htmlspecialchars($log['name']) ?></td><td><?= htmlspecialchars($log['action']) ?></td><td><?= $log['created_at'] ?></td></tr>
<?php endforeach; ?>
</tbody></table></div></div></div>
<?php require APPROOT . '/app/views/layouts/footer.php'; ?>
