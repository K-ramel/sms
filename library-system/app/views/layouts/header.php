<?php $sessionUser = $_SESSION['user'] ?? null; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMIC Library System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/library-system/public/css/app.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark brand-gradient mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/library-system/public/dashboard">CMIC Library</a>
        <div class="d-flex text-white gap-3 align-items-center">
            <?php if ($sessionUser): ?>
                <span><?= htmlspecialchars($sessionUser['name']) ?> (<?= htmlspecialchars($sessionUser['role']) ?>)</span>
                <a href="/library-system/public/logout" class="btn btn-light btn-sm">Logout</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container pb-5">
<?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
<?php endif; ?>
<?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
<?php endif; ?>
