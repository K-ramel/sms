<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index(): void
    {
        $this->requireRole(['Administrator', 'Librarian', 'Student', 'Teacher']);
        $user = Auth::user();

        if ($user['role'] === 'Administrator') {
            $summary = (new Transaction())->reportSummary();
            $this->render('admin/dashboard', ['summary' => $summary, 'user' => $user]);
            return;
        }

        if ($user['role'] === 'Librarian') {
            $requested = (new Transaction())->requested();
            $borrowed = (new Transaction())->borrowedActive();
            $this->render('librarian/dashboard', compact('requested', 'borrowed', 'user'));
            return;
        }

        $history = (new Transaction())->borrowedByUser((int) $user['user_id']);
        $view = $user['role'] === 'Teacher' ? 'teacher/dashboard' : 'student/dashboard';
        $this->render($view, compact('history', 'user'));
    }
}
