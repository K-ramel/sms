<h3>Reports</h3>
<ul>
    <li>Total Users: <?= $summary['users'] ?></li>
    <li>Total Books: <?= $summary['books'] ?></li>
    <li>Borrowed Books: <?= $summary['borrowed'] ?></li>
    <li>Total Penalties: ₱<?= number_format($summary['penalties'], 2) ?></li>
</ul>
<h5>Penalty Monitoring</h5>
<table class="table table-bordered">
<tr><th>Transaction</th><th>User</th><th>Book</th><th>Penalty</th><th>Status</th></tr>
<?php foreach ($penalties as $item): ?>
<tr>
<td><?= $item['transaction_id'] ?></td><td><?= htmlspecialchars($item['fullname']) ?></td><td><?= htmlspecialchars($item['title']) ?></td><td>₱<?= number_format((float) $item['penalty_amount'], 2) ?></td><td><?= htmlspecialchars($item['status']) ?></td>
</tr>
<?php endforeach; ?>
</table>
