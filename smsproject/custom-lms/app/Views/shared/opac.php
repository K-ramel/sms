<h3>OPAC Search (LAN Only)</h3>
<form method="get" action="/opac" class="row g-2 mb-3">
    <div class="col-md-10"><input class="form-control" name="q" value="<?= htmlspecialchars($keyword ?? '') ?>" placeholder="Search by title, author, or category"></div>
    <div class="col-md-2"><button class="btn btn-primary w-100">Search</button></div>
</form>
<table class="table table-hover">
<tr><th>Title</th><th>Author</th><th>Category</th><th>Status</th><th></th></tr>
<?php foreach ($books as $book): ?>
<tr>
<td><?= htmlspecialchars($book['title']) ?></td>
<td><?= htmlspecialchars($book['author']) ?></td>
<td><?= htmlspecialchars($book['category']) ?></td>
<td><?= htmlspecialchars($book['status']) ?></td>
<td>
<?php if ($book['status'] === 'Available' && (int) $book['quantity'] > 0): ?>
    <form method="post" action="/opac/borrow-request">
        <input type="hidden" name="book_id" value="<?= $book['book_id'] ?>">
        <button class="btn btn-sm btn-success">Borrow Request</button>
    </form>
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
</table>
