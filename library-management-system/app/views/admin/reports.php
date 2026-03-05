<?php require APPROOT . '/app/views/layouts/header.php'; require APPROOT . '/app/views/layouts/navbar.php'; ?>
<div class="container-fluid py-4"><div class="row"><div class="col-md-2"><?php require APPROOT . '/app/views/layouts/sidebar.php'; ?></div>
<div class="col-md-10">
<h3>Reports</h3>
<h5>Transactions</h5>
<table class="table table-sm table-bordered"><thead><tr><th>ID</th><th>User</th><th>Book</th><th>Borrow Date</th><th>Due Date</th><th>Status</th></tr></thead><tbody>
<?php foreach ($transactions as $txn): ?>
<tr><td><?= $txn['id'] ?></td><td><?= htmlspecialchars($txn['user_name']) ?></td><td><?= htmlspecialchars($txn['book_title']) ?></td><td><?= $txn['borrow_date'] ?></td><td><?= $txn['due_date'] ?></td><td><?= $txn['status'] ?></td></tr>
<?php endforeach; ?>
</tbody></table>
<h5>Penalties</h5>
<table class="table table-sm table-bordered"><thead><tr><th>ID</th><th>User</th><th>Book</th><th>Days Late</th><th>Amount</th></tr></thead><tbody>
<?php foreach ($penalties as $penalty): ?>
<tr><td><?= $penalty['id'] ?></td><td><?= htmlspecialchars($penalty['user_name']) ?></td><td><?= htmlspecialchars($penalty['book_title']) ?></td><td><?= $penalty['days_late'] ?></td><td>$<?= $penalty['penalty_amount'] ?></td></tr>
<?php endforeach; ?>
</tbody></table>
</div></div></div>
<?php require APPROOT . '/app/views/layouts/footer.php'; ?>
