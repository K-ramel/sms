<h3>User Management</h3>
<h5>Pending Accounts</h5>
<table class="table table-bordered">
<tr><th>Name</th><th>Email</th><th>Role</th><th>Action</th></tr>
<?php foreach ($pending as $user): ?>
<tr>
    <td><?= htmlspecialchars($user['fullname']) ?></td>
    <td><?= htmlspecialchars($user['email']) ?></td>
    <td><?= htmlspecialchars($user['role']) ?></td>
    <td>
        <form method="post" action="/admin/users/approve" class="d-inline">
            <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
            <input type="hidden" name="status" value="Active">
            <button class="btn btn-sm btn-success">Approve</button>
        </form>
        <form method="post" action="/admin/users/approve" class="d-inline">
            <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
            <input type="hidden" name="status" value="Rejected">
            <button class="btn btn-sm btn-danger">Reject</button>
        </form>
    </td>
</tr>
<?php endforeach; ?>
</table>
