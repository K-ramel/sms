<?php

class AdminController extends Controller
{
    private User $userModel;
    private Book $bookModel;
    private Transaction $transactionModel;
    private AuditLog $auditLog;

    public function __construct()
    {
        $this->requireAuth(['admin']);
        $this->userModel = $this->model('User');
        $this->bookModel = $this->model('Book');
        $this->transactionModel = $this->model('Transaction');
        $this->auditLog = $this->model('AuditLog');
    }

    public function dashboard(): void
    {
        $data = [
            'totalUsers' => $this->userModel->total(),
            'totalBooks' => $this->bookModel->total(),
            'borrowedBooks' => $this->transactionModel->borrowedCount(),
            'overdueBooks' => $this->transactionModel->overdueCount(),
        ];

        $this->view('admin/dashboard', $data);
    }

    public function auditLogs(): void
    {
        $this->view('admin/audit_logs', ['logs' => $this->auditLog->all()]);
    }
}
