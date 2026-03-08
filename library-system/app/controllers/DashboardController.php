<?php

namespace App\Controllers;

use Core\Controller;
use Core\Middleware;

class DashboardController extends Controller
{
    public function index(): void
    {
        Middleware::auth();

        $role = $_SESSION['user']['role'];
        $view = match ($role) {
            'Admin' => 'admin/dashboard',
            'Librarian' => 'librarian/dashboard',
            'Teacher' => 'teacher/dashboard',
            default => 'student/dashboard',
        };

        $this->view($view, ['user' => $_SESSION['user']]);
    }
}
