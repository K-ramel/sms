<h3>Book Management</h3>
<form method="post" action="/admin/books/save" class="card card-body mb-4">
    <div class="row g-2">
        <input type="hidden" name="book_id" value="">
        <div class="col-md-3"><input class="form-control" name="title" placeholder="Title" required></div>
        <div class="col-md-2"><input class="form-control" name="author" placeholder="Author" required></div>
        <div class="col-md-2"><input class="form-control" name="category" placeholder="Category" required></div>
        <div class="col-md-2"><input class="form-control" type="number" name="quantity" value="1" required></div>
        <div class="col-md-2"><select class="form-select" name="status"><option>Available</option><option>Borrowed</option></select></div>
        <div class="col-md-1"><button class="btn btn-primary w-100">Save</button></div>
    </div>
</form>
<table class="table table-striped">
<tr><th>Title</th><th>Author</th><th>Category</th><th>Qty</th><th>Status</th><th></th></tr>
<?php foreach ($books as $book): ?>
<tr>
<td><?= htmlspecialchars($book['title']) ?></td><td><?= htmlspecialchars($book['author']) ?></td><td><?= htmlspecialchars($book['category']) ?></td><td><?= $book['quantity'] ?></td><td><?= $book['status'] ?></td>
<td>
    <form method="post" action="/admin/books/delete">
        <input type="hidden" name="book_id" value="<?= $book['book_id'] ?>">
        <button class="btn btn-sm btn-danger">Delete</button>
    </form>
</td>
</tr>
<?php endforeach; ?>
</table>
