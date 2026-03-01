<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Transaction;

class LibrarianController extends Controller
{
    public function confirmBorrow(): void
    {
        $this->requireRole(['Librarian']);
        (new Transaction())->markBorrowed((int) $this->input('transaction_id'));
        $this->redirect('/dashboard');
    }

    public function confirmReturn(): void
    {
        $this->requireRole(['Librarian']);
        (new Transaction())->returnBook((int) $this->input('transaction_id'));
        $this->redirect('/dashboard');
    }

    public function penalties(): void
    {
        $this->requireRole(['Librarian']);
        $penalties = (new Transaction())->penaltyList();
        $this->render('librarian/penalties', compact('penalties'));
    }
}
