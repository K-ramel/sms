<?php

namespace Core;

class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);

        $viewPath = __DIR__ . '/../app/views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            http_response_code(404);
            echo "View {$view} not found.";
            return;
        }

        require __DIR__ . '/../app/views/layouts/header.php';
        require $viewPath;
        require __DIR__ . '/../app/views/layouts/footer.php';
    }

    protected function model(string $model)
    {
        $className = "App\\Models\\{$model}";
        if (class_exists($className)) {
            return new $className();
        }

        throw new \RuntimeException("Model {$model} not found.");
    }

    protected function redirect(string $path): never
    {
        $config = require __DIR__ . '/../config/app.php';
        header('Location: ' . rtrim($config['base_url'], '/') . '/' . ltrim($path, '/'));
        exit;
    }

    protected function csrfToken(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    protected function verifyCsrf(): bool
    {
        return isset($_POST['csrf_token'], $_SESSION['csrf_token'])
            && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']);
    }
}
