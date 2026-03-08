<h2>Librarian Dashboard</h2>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
    <div class="bg-white shadow rounded p-4">
        <p class="text-gray-500">Pending Requests</p>
        <h3 class="text-3xl font-bold text-blue-600"><?= (int)($pendingCount ?? 0) ?></h3>
        <a href="/library-system/public/borrow" class="btn btn-outline-primary btn-sm mt-2">Review Requests</a>
    </div>
    <div class="bg-white shadow rounded p-4">
        <p class="text-gray-500">Active Borrowed Books</p>
        <h3 class="text-3xl font-bold text-green-600"><?= (int)($activeCount ?? 0) ?></h3>
        <a href="/library-system/public/return" class="btn btn-outline-success btn-sm mt-2">Process Returns</a>
    </div>
</div>
