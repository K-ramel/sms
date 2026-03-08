<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Admin Dashboard</h2>
    <div class="space-x-2">
        <a href="/library-system/public/books" class="btn btn-primary btn-sm">Manage Books</a>
        <a href="/library-system/public/admin/users" class="btn btn-secondary btn-sm">Manage Users</a>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Monthly Borrowing Report</div>
            <ul class="list-group list-group-flush">
                <?php foreach (($monthly ?? []) as $row): ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span><?= htmlspecialchars($row['month']) ?></span>
                        <span class="badge bg-primary"><?= (int)$row['total'] ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Annual Borrowing Report</div>
            <ul class="list-group list-group-flush">
                <?php foreach (($annual ?? []) as $row): ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span><?= htmlspecialchars($row['year']) ?></span>
                        <span class="badge bg-success"><?= (int)$row['total'] ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
