<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Book;
use App\Models\Transaction;
use App\Models\User;

class AdminController extends Controller
{
    public function users(): void
    {
        $this->requireRole(['Administrator']);
        $users = (new User())->all();
        $pending = (new User())->pending();
        $this->render('admin/users', compact('users', 'pending'));
    }

    public function approveUser(): void
    {
        $this->requireRole(['Administrator']);
        (new User())->updateStatus((int) $this->input('user_id'), (string) $this->input('status', 'Active'));
        $this->redirect('/admin/users');
    }

    public function books(): void
    {
        $this->requireRole(['Administrator']);
        $books = (new Book())->all();
        $this->render('admin/books', compact('books'));
    }

    public function saveBook(): void
    {
        $this->requireRole(['Administrator']);
        $payload = [
            'title' => (string) $this->input('title'),
            'author' => (string) $this->input('author'),
            'category' => (string) $this->input('category'),
            'quantity' => (int) $this->input('quantity'),
            'status' => (string) $this->input('status', 'Available'),
        ];

        $bookId = (int) $this->input('book_id', 0);
        $bookModel = new Book();

        if ($bookId > 0) {
            $bookModel->update($bookId, $payload);
        } else {
            $bookModel->create($payload);
        }

        $this->redirect('/admin/books');
    }

    public function deleteBook(): void
    {
        $this->requireRole(['Administrator']);
        (new Book())->delete((int) $this->input('book_id'));
        $this->redirect('/admin/books');
    }

    public function reports(): void
    {
        $this->requireRole(['Administrator']);
        $summary = (new Transaction())->reportSummary();
        $penalties = (new Transaction())->penaltyList();
        $this->render('admin/reports', compact('summary', 'penalties'));
    }
}
