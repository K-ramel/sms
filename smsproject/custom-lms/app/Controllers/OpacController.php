<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\Book;
use App\Models\Transaction;

class OpacController extends Controller
{
    public function search(): void
    {
        $this->requireRole(['Student', 'Teacher']);
        $keyword = (string) $this->input('q', '');
        $books = (new Book())->availableByKeyword($keyword);
        $this->render('shared/opac', compact('books', 'keyword'));
    }

    public function requestBorrow(): void
    {
        $this->requireRole(['Student', 'Teacher']);
        (new Transaction())->createRequest((int) Auth::user()['user_id'], (int) $this->input('book_id'));
        $this->redirect('/opac');
    }
}
