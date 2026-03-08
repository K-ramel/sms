<?php require APPROOT . '/app/views/layouts/header.php'; require APPROOT . '/app/views/layouts/navbar.php'; ?>
<div class="container-fluid py-4"><div class="row"><div class="col-md-2"><?php require APPROOT . '/app/views/layouts/sidebar.php'; ?></div>
<div class="col-md-10">
<h3>Search Books (OPAC)</h3>
<form method="GET" action="<?= URLROOT ?>/library/search" class="mb-3 d-flex gap-2">
<input class="form-control" name="q" value="<?= htmlspecialchars($keyword ?? '') ?>" placeholder="Search by title, author, category...">
<button class="btn btn-primary">Search</button>
</form>
<table class="table table-striped table-bordered"><thead><tr><th>Title</th><th>Author</th><th>Category</th><th>ISBN</th><th>Available</th><th></th></tr></thead><tbody>
<?php foreach ($books as $book): ?>
<tr><td><?= htmlspecialchars($book['title']) ?></td><td><?= htmlspecialchars($book['author']) ?></td><td><?= htmlspecialchars($book['category']) ?></td><td><?= htmlspecialchars($book['isbn']) ?></td><td><?= $book['available'] ?></td><td><?php if ((int) $book['available'] > 0): ?><a class="btn btn-sm btn-success" href="<?= URLROOT ?>/library/borrow/<?= $book['id'] ?>">Borrow</a><?php else: ?><span class="badge text-bg-secondary">Unavailable</span><?php endif; ?></td></tr>
<?php endforeach; ?>
</tbody></table>
</div></div></div>
<?php require APPROOT . '/app/views/layouts/footer.php'; ?>
