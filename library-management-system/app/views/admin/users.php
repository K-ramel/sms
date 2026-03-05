<?php require APPROOT . '/app/views/layouts/header.php'; require APPROOT . '/app/views/layouts/navbar.php'; ?>
<div class="container-fluid py-4"><div class="row"><div class="col-md-2"><?php require APPROOT . '/app/views/layouts/sidebar.php'; ?></div>
<div class="col-md-10">
<h3>User Management</h3>
<table class="table table-bordered table-striped"><thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th></th></tr></thead><tbody>
<?php foreach ($users as $user): ?>
<tr><td><?= $user['id'] ?></td><td><?= htmlspecialchars($user['name']) ?></td><td><?= htmlspecialchars($user['email']) ?></td><td><?= htmlspecialchars($user['role']) ?></td><td><a class="btn btn-sm btn-danger" href="<?= URLROOT ?>/user/delete/<?= $user['id'] ?>">Delete</a></td></tr>
<?php endforeach; ?>
</tbody></table></div></div></div>
<?php require APPROOT . '/app/views/layouts/footer.php'; ?>
