<?php

class ReportController extends Controller
{
    private Transaction $transactionModel;
    private Penalty $penaltyModel;

    public function __construct()
    {
        $this->requireAuth(['admin']);
        $this->transactionModel = $this->model('Transaction');
        $this->penaltyModel = $this->model('Penalty');
    }

    public function index(): void
    {
        $this->view('admin/reports', [
            'transactions' => $this->transactionModel->all(),
            'penalties' => $this->penaltyModel->all(),
        ]);
    }
}
