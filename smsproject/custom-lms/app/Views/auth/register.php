<h3>Register (Student/Teacher)</h3>
<?php if (!empty($success)): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
<form method="post" action="/register" class="card card-body">
    <div class="row g-3">
        <div class="col-md-6"><label>School ID</label><input class="form-control" name="school_id" required></div>
        <div class="col-md-6"><label>Full Name</label><input class="form-control" name="fullname" required></div>
        <div class="col-md-6"><label>Email</label><input type="email" class="form-control" name="email" required></div>
        <div class="col-md-6"><label>Password</label><input type="password" class="form-control" name="password" required></div>
        <div class="col-md-6"><label>Department</label><input class="form-control" name="department" required></div>
        <div class="col-md-6"><label>Role</label><select name="role" class="form-select"><option>Student</option><option>Teacher</option></select></div>
    </div>
    <button class="btn btn-success mt-3">Submit Registration</button>
</form>
