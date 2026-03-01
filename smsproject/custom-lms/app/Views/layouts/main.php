<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMICI Library Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">CMICI LMS</a>
        <div class="d-flex gap-2">
            <?php if (!empty($_SESSION['user'])): ?>
                <a class="btn btn-sm btn-light" href="/dashboard">Dashboard</a>
                <a class="btn btn-sm btn-warning" href="/logout">Logout</a>
            <?php else: ?>
                <a class="btn btn-sm btn-light" href="/login">Login</a>
                <a class="btn btn-sm btn-success" href="/register">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container pb-5">
    <?= $content ?>
</div>
</body>
</html>
