<h2 class="mb-3">User Management</h2>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Status</th><th>Action</th></tr></thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td><span class="badge bg-info text-dark"><?= htmlspecialchars($user['status']) ?></span></td>
                    <td>
                        <form method="POST" action="/library-system/public/admin/users/status" class="d-flex gap-2">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf ?? '') ?>">
                            <input type="hidden" name="id" value="<?= (int)$user['id'] ?>">
                            <select name="status" class="form-select form-select-sm">
                                <option>Approved</option>
                                <option>Rejected</option>
                                <option>Blocked</option>
                                <option>Pending</option>
                            </select>
                            <button class="btn btn-sm btn-primary">Save</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
