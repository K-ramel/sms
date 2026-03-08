<?php require APPROOT . '/app/views/layouts/header.php'; require APPROOT . '/app/views/layouts/navbar.php'; ?>
<div class="container-fluid py-4"><div class="row"><div class="col-md-2"><?php require APPROOT . '/app/views/layouts/sidebar.php'; ?></div>
<div class="col-md-10">
<h3>Books Management</h3>
<form method="POST" action="<?= URLROOT ?>/book/create" class="row g-2 mb-3">
<input class="form-control col" name="title" placeholder="Title" required>
<input class="form-control col" name="author" placeholder="Author" required>
<input class="form-control col" name="category" placeholder="Category" required>
<input class="form-control col" name="isbn" placeholder="ISBN" required>
<input class="form-control col" type="number" min="1" name="quantity" placeholder="Qty" required>
<button class="btn btn-primary col-md-2">Add Book</button>
</form>
<table class="table table-bordered table-striped"><thead><tr><th>ID</th><th>Title</th><th>Author</th><th>Cat.</th><th>ISBN</th><th>Qty</th><th>Avail.</th><th></th></tr></thead><tbody>
<?php foreach ($books as $book): ?>
<tr><td><?= $book['id'] ?></td><td><?= htmlspecialchars($book['title']) ?></td><td><?= htmlspecialchars($book['author']) ?></td><td><?= htmlspecialchars($book['category']) ?></td><td><?= htmlspecialchars($book['isbn']) ?></td><td><?= $book['quantity'] ?></td><td><?= $book['available'] ?></td><td><a class="btn btn-sm btn-danger" href="<?= URLROOT ?>/book/delete/<?= $book['id'] ?>">Delete</a></td></tr>
<?php endforeach; ?>
</tbody></table></div></div></div>
<?php require APPROOT . '/app/views/layouts/footer.php'; ?>
