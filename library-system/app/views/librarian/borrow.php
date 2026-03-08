<h2 class="mb-3">Borrow Request Queue</h2>
<div class="card">
    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead><tr><th>Borrower</th><th>Book</th><th>Due Date</th><th>Action</th></tr></thead>
            <tbody>
            <?php foreach ($pending as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= htmlspecialchars($item['title']) ?></td>
                    <td><?= htmlspecialchars($item['due_date']) ?></td>
                    <td>
                        <form method="POST" action="/library-system/public/borrow/confirm">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf ?? '') ?>">
                            <input type="hidden" name="transaction_id" value="<?= (int)$item['id'] ?>">
                            <button class="btn btn-success btn-sm">Confirm Borrow</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
