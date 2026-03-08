<h2 class="mb-3">Book Management</h2>

<div class="card mb-4">
    <div class="card-header">Add Book</div>
    <div class="card-body">
        <form method="POST" action="/library-system/public/books/store" class="row g-2">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf ?? '') ?>">
            <div class="col-md-3"><input type="text" name="title" class="form-control" placeholder="Title" required></div>
            <div class="col-md-2"><input type="text" name="author" class="form-control" placeholder="Author" required></div>
            <div class="col-md-2"><input type="text" name="category" class="form-control" placeholder="Category" required></div>
            <div class="col-md-2"><input type="number" name="year" class="form-control" placeholder="Year" required></div>
            <div class="col-md-2"><button class="btn btn-primary w-100">Add</button></div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">Catalog</div>
    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead><tr><th>Title</th><th>Author</th><th>Category</th><th>Year</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= htmlspecialchars($book['title']) ?></td>
                    <td><?= htmlspecialchars($book['author']) ?></td>
                    <td><?= htmlspecialchars($book['category']) ?></td>
                    <td><?= (int)$book['year'] ?></td>
                    <td><?= htmlspecialchars($book['status']) ?></td>
                    <td>
                        <form class="d-inline" method="POST" action="/library-system/public/books/delete">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf ?? '') ?>">
                            <input type="hidden" name="id" value="<?= (int)$book['id'] ?>">
                            <button class="btn btn-danger btn-sm" data-confirm="Delete this book?">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
