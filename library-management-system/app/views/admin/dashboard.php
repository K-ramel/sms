<?php require APPROOT . '/app/views/layouts/header.php'; require APPROOT . '/app/views/layouts/navbar.php'; ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-2"><?php require APPROOT . '/app/views/layouts/sidebar.php'; ?></div>
        <div class="col-md-10">
            <h3>Admin Dashboard</h3>
            <div class="row g-3 mt-2">
                <div class="col-md-3"><div class="card"><div class="card-body"><h6>Total Users</h6><h2><?= $totalUsers ?></h2></div></div></div>
                <div class="col-md-3"><div class="card"><div class="card-body"><h6>Total Books</h6><h2><?= $totalBooks ?></h2></div></div></div>
                <div class="col-md-3"><div class="card"><div class="card-body"><h6>Borrowed Books</h6><h2><?= $borrowedBooks ?></h2></div></div></div>
                <div class="col-md-3"><div class="card"><div class="card-body"><h6>Overdue Books</h6><h2><?= $overdueBooks ?></h2></div></div></div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/app/views/layouts/footer.php'; ?>
