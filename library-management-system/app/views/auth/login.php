<?php require APPROOT . '/app/views/layouts/header.php'; ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="mb-3">Login</h4>
                    <?php if (!empty($_SESSION['flash_error'])): ?>
                        <div class="alert alert-danger"><?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?></div>
                    <?php endif; ?>
                    <?php if (!empty($_SESSION['flash_success'])): ?>
                        <div class="alert alert-success"><?= $_SESSION['flash_success']; unset($_SESSION['flash_success']); ?></div>
                    <?php endif; ?>
                    <form method="POST" action="<?= URLROOT ?>/auth/login">
                        <div class="mb-3"><label class="form-label">Email</label><input class="form-control" type="email" name="email" required></div>
                        <div class="mb-3"><label class="form-label">Password</label><input class="form-control" type="password" name="password" required></div>
                        <button class="btn btn-primary w-100" type="submit">Login</button>
                    </form>
                    <a href="<?= URLROOT ?>/auth/register" class="btn btn-link w-100 mt-2">Create account</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/app/views/layouts/footer.php'; ?>
