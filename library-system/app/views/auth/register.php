<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">Register</div>
            <div class="card-body">
                <form method="POST" action="/library-system/public/register" class="row g-3">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf ?? '') ?>">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Student/Employee ID</label>
                        <input type="text" name="student_id" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select">
                            <option>Student</option>
                            <option>Teacher</option>
                            <option>Librarian</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" minlength="6" required>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-success w-100">Submit Registration</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
