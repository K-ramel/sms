<?php

declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    protected function render(string $view, array $params = [], string $layout = 'main'): void
    {
        View::render($view, $params, $layout);
    }

    protected function redirect(string $path): void
    {
        header('Location: ' . $path);
        exit;
    }

    protected function input(string $key, mixed $default = null): mixed
    {
        return $_POST[$key] ?? $_GET[$key] ?? $default;
    }

    protected function requireRole(array $roles): void
    {
        if (empty($_SESSION['user'])) {
            $this->redirect('/login');
        }

        if (!in_array($_SESSION['user']['role'], $roles, true)) {
            http_response_code(403);
            exit('Forbidden');
        }
    }
}
