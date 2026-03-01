<table class="table table-bordered">
<tr><th>Book</th><th>Borrow Date</th><th>Due Date</th><th>Return Date</th><th>Penalty</th><th>Status</th></tr>
<?php foreach ($history as $item): ?>
<tr>
<td><?= htmlspecialchars($item['title']) ?></td>
<td><?= $item['borrow_date'] ?></td>
<td><?= $item['due_date'] ?></td>
<td><?= $item['return_date'] ?? '-' ?></td>
<td>₱<?= number_format((float) $item['penalty_amount'], 2) ?></td>
<td><?= htmlspecialchars($item['status']) ?></td>
</tr>
<?php endforeach; ?>
</table>
