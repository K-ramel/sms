<?php require APPROOT . '/app/views/layouts/header.php'; require APPROOT . '/app/views/layouts/navbar.php'; ?>
<div class="container-fluid py-4"><div class="row"><div class="col-md-2"><?php require APPROOT . '/app/views/layouts/sidebar.php'; ?></div>
<div class="col-md-10">
<h3>Librarian Dashboard</h3>
<div class="card mb-3"><div class="card-header">Confirm Borrow</div><div class="card-body">
<form method="POST" action="<?= URLROOT ?>/librarian/confirmBorrow" class="row g-2">
<input class="form-control col" type="number" name="user_id" placeholder="User ID" required>
<input class="form-control col" type="number" name="book_id" placeholder="Book ID" required>
<input class="form-control col" type="date" name="due_date" required>
<button class="btn btn-primary col-md-2">Confirm Borrow</button>
</form></div></div>

<h5>Borrow / Return Queue</h5>
<table class="table table-bordered"><thead><tr><th>ID</th><th>User</th><th>Book</th><th>Status</th><th>Due</th><th></th></tr></thead><tbody>
<?php foreach ($transactions as $txn): ?>
<tr><td><?= $txn['id'] ?></td><td><?= htmlspecialchars($txn['user_name']) ?></td><td><?= htmlspecialchars($txn['book_title']) ?></td><td><?= $txn['status'] ?></td><td><?= $txn['due_date'] ?></td><td><?php if ($txn['status'] === 'borrowed'): ?><a class="btn btn-sm btn-success" href="<?= URLROOT ?>/librarian/confirmReturn/<?= $txn['id'] ?>">Confirm Return</a><?php endif; ?></td></tr>
<?php endforeach; ?>
</tbody></table>

<h5>Penalties</h5>
<table class="table table-bordered"><thead><tr><th>ID</th><th>User</th><th>Book</th><th>Days Late</th><th>Amount</th></tr></thead><tbody>
<?php foreach ($penalties as $penalty): ?>
<tr><td><?= $penalty['id'] ?></td><td><?= htmlspecialchars($penalty['user_name']) ?></td><td><?= htmlspecialchars($penalty['book_title']) ?></td><td><?= $penalty['days_late'] ?></td><td>$<?= $penalty['penalty_amount'] ?></td></tr>
<?php endforeach; ?>
</tbody></table>
</div></div></div>
<?php require APPROOT . '/app/views/layouts/footer.php'; ?>
