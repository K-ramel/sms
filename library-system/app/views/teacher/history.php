<h2>Teacher Borrow History</h2>
<div class="card">
    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead><tr><th>Book</th><th>Borrow Date</th><th>Due Date</th><th>Return Date</th><th>Status</th></tr></thead>
            <tbody>
            <?php foreach (($history ?? []) as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['title']) ?></td>
                    <td><?= htmlspecialchars($item['borrow_date']) ?></td>
                    <td><?= htmlspecialchars($item['due_date']) ?></td>
                    <td><?= htmlspecialchars($item['return_date'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($item['status']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
