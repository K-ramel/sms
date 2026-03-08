<?php

class BookController extends Controller
{
    private Book $bookModel;
    private AuditLog $auditLog;

    public function __construct()
    {
        $this->requireAuth(['admin']);
        $this->bookModel = $this->model('Book');
        $this->auditLog = $this->model('AuditLog');
    }

    public function index(): void
    {
        $this->view('admin/books', ['books' => $this->bookModel->all()]);
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => trim($_POST['title']),
                'author' => trim($_POST['author']),
                'category' => trim($_POST['category']),
                'isbn' => trim($_POST['isbn']),
                'quantity' => (int) $_POST['quantity'],
                'available' => (int) $_POST['quantity'],
            ];

            if ($this->bookModel->create($data)) {
                $this->auditLog->create(['user_id' => $_SESSION['user']['id'], 'action' => 'Added book: ' . $data['title']]);
            }
        }

        $this->redirect('book/index');
    }

    public function delete($id): void
    {
        $book = $this->bookModel->find((int) $id);
        if ($book && $this->bookModel->delete((int) $id)) {
            $this->auditLog->create(['user_id' => $_SESSION['user']['id'], 'action' => 'Deleted book: ' . $book['title']]);
        }

        $this->redirect('book/index');
    }
}
