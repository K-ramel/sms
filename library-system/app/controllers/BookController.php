<?php

namespace App\Controllers;

use Core\Controller;
use Core\Middleware;

class BookController extends Controller
{
    public function index(): void
    {
        Middleware::auth();
        $books = $this->model('Book')->all();

        $this->view('admin/books', ['books' => $books, 'csrf' => $this->csrfToken()]);
    }

    public function store(): void
    {
        Middleware::role(['Admin']);

        if (!$this->verifyCsrf()) {
            die('Invalid CSRF token.');
        }

        $this->model('Book')->create([
            'title' => trim($_POST['title'] ?? ''),
            'author' => trim($_POST['author'] ?? ''),
            'category' => trim($_POST['category'] ?? ''),
            'year' => (int)($_POST['year'] ?? date('Y')),
            'status' => 'Available',
        ]);

        $this->redirect('books');
    }

    public function update(): void
    {
        Middleware::role(['Admin']);
        if (!$this->verifyCsrf()) {
            die('Invalid CSRF token.');
        }

        $id = (int)($_POST['id'] ?? 0);
        $this->model('Book')->update($id, [
            'title' => trim($_POST['title'] ?? ''),
            'author' => trim($_POST['author'] ?? ''),
            'category' => trim($_POST['category'] ?? ''),
            'year' => (int)($_POST['year'] ?? date('Y')),
            'status' => trim($_POST['status'] ?? 'Available'),
        ]);

        $this->redirect('books');
    }

    public function delete(): void
    {
        Middleware::role(['Admin']);
        if (!$this->verifyCsrf()) {
            die('Invalid CSRF token.');
        }

        $this->model('Book')->delete((int)($_POST['id'] ?? 0));
        $this->redirect('books');
    }

    public function opac(): void
    {
        Middleware::role(['Student', 'Teacher']);
        $keyword = trim($_GET['q'] ?? '');

        $bookModel = $this->model('Book');
        $books = $keyword ? $bookModel->search($keyword) : $bookModel->all();

        $this->view('student/opac', [
            'books' => $books,
            'keyword' => $keyword,
            'csrf' => $this->csrfToken(),
        ]);
    }
}
