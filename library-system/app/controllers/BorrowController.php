<?php

namespace App\Controllers;

use Core\Controller;
use Core\Middleware;

class BorrowController extends Controller
{
    public function index(): void
    {
        Middleware::role(['Librarian']);
        $pending = $this->model('Transaction')->pending();

        $this->view('librarian/borrow', ['pending' => $pending, 'csrf' => $this->csrfToken()]);
    }

    public function request(): void
    {
        Middleware::role(['Student', 'Teacher']);
        if (!$this->verifyCsrf()) {
            die('Invalid CSRF token.');
        }

        $bookId = (int)($_POST['book_id'] ?? 0);
        $dueDate = date('Y-m-d', strtotime('+7 days'));

        $this->model('Transaction')->createBorrowRequest($_SESSION['user']['id'], $bookId, $dueDate);
        $this->logAudit('borrow_request', 'Borrow request submitted.');

        $this->redirect('opac');
    }

    public function confirm(): void
    {
        Middleware::role(['Librarian']);
        if (!$this->verifyCsrf()) {
            die('Invalid CSRF token.');
        }

        $transactionId = (int)($_POST['transaction_id'] ?? 0);
        $transactionModel = $this->model('Transaction');
        $bookModel = $this->model('Book');

        $transaction = $transactionModel->find($transactionId);
        if ($transaction) {
            $transactionModel->confirmBorrow($transactionId);
            $bookModel->setStatus((int)$transaction['book_id'], 'Borrowed');
            $this->logAudit('borrow_confirm', "Transaction #{$transactionId} confirmed.");
        }

        $this->redirect('borrow');
    }

    public function history(): void
    {
        Middleware::role(['Student', 'Teacher']);

        $history = $this->model('Transaction')->userHistory($_SESSION['user']['id']);
        $role = $_SESSION['user']['role'];
        $view = $role === 'Teacher' ? 'teacher/history' : 'student/history';

        $this->view($view, ['history' => $history]);
    }

    private function logAudit(string $action, string $description): void
    {
        $line = sprintf("[%s] %s: %s%s", date('Y-m-d H:i:s'), $action, $description, PHP_EOL);
        file_put_contents(__DIR__ . '/../../storage/audit.log', $line, FILE_APPEND);
    }
}
