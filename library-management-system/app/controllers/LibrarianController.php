<?php

class LibrarianController extends Controller
{
    private Transaction $transactionModel;
    private Penalty $penaltyModel;
    private Book $bookModel;
    private AuditLog $auditLog;

    public function __construct()
    {
        $this->requireAuth(['librarian']);
        $this->transactionModel = $this->model('Transaction');
        $this->penaltyModel = $this->model('Penalty');
        $this->bookModel = $this->model('Book');
        $this->auditLog = $this->model('AuditLog');
    }

    public function dashboard(): void
    {
        $this->view('librarian/dashboard', [
            'transactions' => $this->transactionModel->all(),
            'penalties' => $this->penaltyModel->all(),
        ]);
    }

    public function confirmBorrow(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_id' => (int) $_POST['user_id'],
                'book_id' => (int) $_POST['book_id'],
                'borrow_date' => date('Y-m-d'),
                'due_date' => $_POST['due_date'],
                'status' => 'borrowed',
            ];

            if ($this->transactionModel->create($data)) {
                $this->bookModel->adjustAvailability($data['book_id'], -1);
                $this->auditLog->create(['user_id' => $_SESSION['user']['id'], 'action' => 'Borrow confirmed for user #' . $data['user_id']]);
            }
        }

        $this->redirect('librarian/dashboard');
    }

    public function confirmReturn($id): void
    {
        $transaction = $this->transactionModel->find((int) $id);

        if ($transaction && $transaction['status'] === 'borrowed') {
            $this->transactionModel->markReturned((int) $id);
            $this->bookModel->adjustAvailability((int) $transaction['book_id'], 1);

            $daysLate = (int) max(0, floor((strtotime(date('Y-m-d')) - strtotime($transaction['due_date'])) / 86400));
            if ($daysLate > 0) {
                $this->penaltyModel->create([
                    'transaction_id' => (int) $id,
                    'days_late' => $daysLate,
                    'penalty_amount' => $daysLate * 1.5,
                ]);
            }

            $this->auditLog->create(['user_id' => $_SESSION['user']['id'], 'action' => 'Return confirmed for transaction #' . $id]);
        }

        $this->redirect('librarian/dashboard');
    }
}
