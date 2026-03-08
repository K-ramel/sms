<?php

namespace App\Controllers;

use Core\Controller;
use Core\Middleware;

class ReturnController extends Controller
{
    public function index(): void
    {
        Middleware::role(['Librarian']);
        $active = $this->model('Transaction')->active();

        $this->view('librarian/return', ['active' => $active, 'csrf' => $this->csrfToken()]);
    }

    public function process(): void
    {
        Middleware::role(['Librarian']);

        if (!$this->verifyCsrf()) {
            die('Invalid CSRF token.');
        }

        $transactionId = (int)($_POST['transaction_id'] ?? 0);
        $transactionModel = $this->model('Transaction');
        $transaction = $transactionModel->find($transactionId);

        if ($transaction) {
            $transactionModel->completeReturn($transactionId);
            $this->model('Book')->setStatus((int)$transaction['book_id'], 'Available');

            $lateDays = max(0, (int)floor((time() - strtotime($transaction['due_date'])) / 86400));
            $penaltyAmount = $lateDays > 0 ? $lateDays * 10.0 : 0.0;
            $this->model('Penalty')->create($transactionId, $penaltyAmount);

            $this->logAudit('return', "Transaction #{$transactionId} returned. Penalty: {$penaltyAmount}");
        }

        $this->redirect('return');
    }

    private function logAudit(string $action, string $description): void
    {
        $line = sprintf("[%s] %s: %s%s", date('Y-m-d H:i:s'), $action, $description, PHP_EOL);
        file_put_contents(__DIR__ . '/../../storage/audit.log', $line, FILE_APPEND);
    }
}
