<?php

class LibraryController extends Controller
{
    private Book $bookModel;
    private Transaction $transactionModel;
    private Penalty $penaltyModel;
    private AuditLog $auditLog;

    public function __construct()
    {
        $this->requireAuth(['student', 'teacher']);
        $this->bookModel = $this->model('Book');
        $this->transactionModel = $this->model('Transaction');
        $this->penaltyModel = $this->model('Penalty');
        $this->auditLog = $this->model('AuditLog');
    }

    public function dashboard(): void
    {
        $this->view('library/dashboard');
    }

    public function search(): void
    {
        $keyword = trim($_GET['q'] ?? '');
        $books = $keyword === '' ? $this->bookModel->all() : $this->bookModel->search($keyword);
        $this->view('library/search_books', ['books' => $books, 'keyword' => $keyword]);
    }

    public function borrow($bookId): void
    {
        $bookId = (int) $bookId;
        $book = $this->bookModel->find($bookId);

        if ($book && (int) $book['available'] > 0) {
            $this->transactionModel->create([
                'user_id' => (int) $_SESSION['user']['id'],
                'book_id' => $bookId,
                'borrow_date' => date('Y-m-d'),
                'due_date' => date('Y-m-d', strtotime('+7 days')),
                'status' => 'borrowed',
            ]);
            $this->bookModel->adjustAvailability($bookId, -1);
            $this->auditLog->create(['user_id' => $_SESSION['user']['id'], 'action' => 'Borrow request submitted for book #' . $bookId]);
        }

        $this->redirect('library/borrowed');
    }

    public function borrowed(): void
    {
        $this->view('library/borrowed_books', [
            'transactions' => $this->transactionModel->byUser((int) $_SESSION['user']['id']),
            'penalties' => $this->penaltyModel->byUser((int) $_SESSION['user']['id']),
        ]);
    }
}
