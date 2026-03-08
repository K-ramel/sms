<?php require APPROOT . '/app/views/layouts/header.php'; require APPROOT . '/app/views/layouts/navbar.php'; ?>
<div class="container-fluid py-4"><div class="row"><div class="col-md-2"><?php require APPROOT . '/app/views/layouts/sidebar.php'; ?></div>
<div class="col-md-10">
<h3>Borrowed Books</h3>
<table class="table table-bordered"><thead><tr><th>Book</th><th>Author</th><th>Borrow Date</th><th>Due Date</th><th>Status</th></tr></thead><tbody>
<?php foreach ($transactions as $txn): ?>
<tr><td><?= htmlspecialchars($txn['title']) ?></td><td><?= htmlspecialchars($txn['author']) ?></td><td><?= $txn['borrow_date'] ?></td><td><?= $txn['due_date'] ?></td><td><?= $txn['status'] ?></td></tr>
<?php endforeach; ?>
</tbody></table>

<h4>Penalties</h4>
<table class="table table-bordered"><thead><tr><th>Book</th><th>Days Late</th><th>Penalty</th></tr></thead><tbody>
<?php foreach ($penalties as $penalty): ?>
<tr><td><?= htmlspecialchars($penalty['title']) ?></td><td><?= $penalty['days_late'] ?></td><td>$<?= $penalty['penalty_amount'] ?></td></tr>
<?php endforeach; ?>
</tbody></table>
</div></div></div>
<?php require APPROOT . '/app/views/layouts/footer.php'; ?>
