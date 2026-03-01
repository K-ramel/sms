<h3>Penalty Monitoring</h3>
<table class="table table-striped">
<tr><th>Transaction</th><th>User</th><th>Book</th><th>Penalty</th><th>Status</th></tr>
<?php foreach ($penalties as $item): ?>
<tr>
<td><?= $item['transaction_id'] ?></td>
<td><?= htmlspecialchars($item['fullname']) ?></td>
<td><?= htmlspecialchars($item['title']) ?></td>
<td>₱<?= number_format((float) $item['penalty_amount'], 2) ?></td>
<td><?= htmlspecialchars($item['status']) ?></td>
</tr>
<?php endforeach; ?>
</table>
