<h3>Login</h3>
<?php if (!empty($error)): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="post" action="/login" class="card card-body">
    <div class="mb-3"><label>Email</label><input class="form-control" name="email" required></div>
    <div class="mb-3"><label>Password</label><input type="password" class="form-control" name="password" required></div>
    <button class="btn btn-primary">Login</button>
</form>
