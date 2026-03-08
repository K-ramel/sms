<?php

namespace App\Controllers;

use Core\Controller;
use Core\Middleware;

class LibrarianController extends Controller
{
    public function dashboard(): void
    {
        Middleware::role(['Librarian']);

        $pending = $this->model('Transaction')->pending();
        $active = $this->model('Transaction')->active();

        $this->view('librarian/dashboard', [
            'user' => $_SESSION['user'],
            'pendingCount' => count($pending),
            'activeCount' => count($active),
        ]);
    }
}
