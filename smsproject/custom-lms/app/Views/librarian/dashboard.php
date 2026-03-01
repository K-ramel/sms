<h3>Librarian Dashboard</h3>
<h5>Borrow Requests</h5>
<table class="table table-sm table-striped">
<tr><th>ID</th><th>User</th><th>Book</th><th>Due Date</th><th>Action</th></tr>
<?php foreach ($requested as $item): ?>
<tr>
<td><?= $item['transaction_id'] ?></td><td><?= htmlspecialchars($item['fullname']) ?></td><td><?= htmlspecialchars($item['title']) ?></td><td><?= $item['due_date'] ?></td>
<td>
    <form method="post" action="/librarian/borrow/confirm">
        <input type="hidden" name="transaction_id" value="<?= $item['transaction_id'] ?>">
        <button class="btn btn-sm btn-success">Confirm Borrow</button>
    </form>
</td>
</tr>
<?php endforeach; ?>
</table>
<h5>Borrowed Books (Return Confirmation)</h5>
<table class="table table-sm table-bordered">
<tr><th>ID</th><th>User</th><th>Book</th><th>Due Date</th><th>Action</th></tr>
<?php foreach ($borrowed as $item): ?>
<tr>
<td><?= $item['transaction_id'] ?></td><td><?= htmlspecialchars($item['fullname']) ?></td><td><?= htmlspecialchars($item['title']) ?></td><td><?= $item['due_date'] ?></td>
<td>
    <form method="post" action="/librarian/return/confirm">
        <input type="hidden" name="transaction_id" value="<?= $item['transaction_id'] ?>">
        <button class="btn btn-sm btn-primary">Confirm Return</button>
    </form>
</td>
</tr>
<?php endforeach; ?>
</table>
<a href="/librarian/penalties" class="btn btn-outline-danger">Penalty Monitoring</a>
