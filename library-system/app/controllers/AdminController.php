<?php

namespace App\Controllers;

use Core\Controller;
use Core\Middleware;

class AdminController extends Controller
{
    public function users(): void
    {
        Middleware::role(['Admin']);
        $users = $this->model('User')->all();

        $this->view('admin/users', ['users' => $users, 'csrf' => $this->csrfToken()]);
    }

    public function updateUserStatus(): void
    {
        Middleware::role(['Admin']);
        if (!$this->verifyCsrf()) {
            die('Invalid CSRF token.');
        }

        $id = (int)($_POST['id'] ?? 0);
        $status = trim($_POST['status'] ?? 'Pending');

        $allowed = ['Approved', 'Rejected', 'Blocked', 'Pending'];
        if (!in_array($status, $allowed, true)) {
            $status = 'Pending';
        }

        $this->model('User')->updateStatus($id, $status);
        $this->logAudit('admin_user_status', "Updated user #{$id} to {$status}");

        $this->redirect('admin/users');
    }

    public function reports(): void
    {
        Middleware::role(['Admin']);

        $transactionModel = $this->model('Transaction');
        $monthly = $transactionModel->monthlyReport();
        $annual = $transactionModel->annualReport();

        $this->view('admin/dashboard', [
            'user' => $_SESSION['user'],
            'monthly' => $monthly,
            'annual' => $annual,
        ]);
    }

    private function logAudit(string $action, string $description): void
    {
        $line = sprintf("[%s] %s: %s%s", date('Y-m-d H:i:s'), $action, $description, PHP_EOL);
        file_put_contents(__DIR__ . '/../../storage/audit.log', $line, FILE_APPEND);
    }
}
