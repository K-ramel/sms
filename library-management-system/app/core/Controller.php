<?php

class Controller
{
    protected function model(string $model)
    {
        require_once APPROOT . '/app/models/' . $model . '.php';
        return new $model();
    }

    protected function view(string $view, array $data = []): void
    {
        $viewFile = APPROOT . '/app/views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            die('View does not exist: ' . $view);
        }

        extract($data);
        require $viewFile;
    }

    protected function redirect(string $path): void
    {
        header('Location: ' . URLROOT . '/' . $path);
        exit;
    }

    protected function requireAuth(array $roles = []): void
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('auth/login');
        }

        if (!empty($roles) && !in_array($_SESSION['user']['role'], $roles, true)) {
            http_response_code(403);
            die('Forbidden');
        }
    }
}
