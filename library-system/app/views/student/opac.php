<h2 class="mb-3">OPAC Search</h2>
<form method="GET" action="/library-system/public/opac" class="row g-2 mb-3">
    <div class="col-md-10">
        <input type="text" class="form-control" name="q" value="<?= htmlspecialchars($keyword ?? '') ?>" placeholder="Search by title, author, or category">
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary w-100">Search</button>
    </div>
</form>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
<?php foreach ($books as $book): ?>
    <div class="bg-white rounded shadow p-4">
        <h5 class="font-bold"><?= htmlspecialchars($book['title']) ?></h5>
        <p class="mb-1">Author: <?= htmlspecialchars($book['author']) ?></p>
        <p class="mb-2">Status: <span class="badge bg-<?= $book['status'] === 'Available' ? 'success' : 'secondary' ?>"><?= htmlspecialchars($book['status']) ?></span></p>
        <?php if ($book['status'] === 'Available'): ?>
            <form method="POST" action="/library-system/public/borrow/request">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf ?? '') ?>">
                <input type="hidden" name="book_id" value="<?= (int)$book['id'] ?>">
                <button class="btn btn-sm btn-outline-primary">Request Borrow</button>
            </form>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
</div>
