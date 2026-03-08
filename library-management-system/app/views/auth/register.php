<?php require APPROOT . '/app/views/layouts/header.php'; ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="mb-3">Register</h4>
                    <form method="POST" action="<?= URLROOT ?>/auth/register">
                        <div class="mb-3"><label class="form-label">Name</label><input class="form-control" name="name" required></div>
                        <div class="mb-3"><label class="form-label">Email</label><input class="form-control" type="email" name="email" required></div>
                        <div class="mb-3"><label class="form-label">Password</label><input class="form-control" type="password" name="password" required></div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select class="form-select" name="role">
                                <option value="student">Student</option>
                                <option value="teacher">Teacher</option>
                                <option value="librarian">Librarian</option>
                            </select>
                        </div>
                        <button class="btn btn-success w-100" type="submit">Register</button>
                    </form>
                    <a href="<?= URLROOT ?>/auth/login" class="btn btn-link w-100 mt-2">Back to login</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/app/views/layouts/footer.php'; ?>
