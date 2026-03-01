<h3>Administrator Dashboard</h3>
<div class="row g-3">
  <div class="col-md-3"><div class="card card-body"><strong>Total Users</strong><span><?= $summary['users'] ?></span></div></div>
  <div class="col-md-3"><div class="card card-body"><strong>Total Books</strong><span><?= $summary['books'] ?></span></div></div>
  <div class="col-md-3"><div class="card card-body"><strong>Borrowed</strong><span><?= $summary['borrowed'] ?></span></div></div>
  <div class="col-md-3"><div class="card card-body"><strong>Total Penalties</strong><span>₱<?= number_format($summary['penalties'], 2) ?></span></div></div>
</div>
<div class="mt-4 d-flex gap-2">
    <a href="/admin/users" class="btn btn-outline-primary">Manage Users</a>
    <a href="/admin/books" class="btn btn-outline-primary">Manage Books</a>
    <a href="/admin/reports" class="btn btn-outline-primary">Reports</a>
</div>
