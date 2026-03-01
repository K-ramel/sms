<?php

declare(strict_types=1);

use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\LibrarianController;
use App\Controllers\OpacController;

$router->get('/', [AuthController::class, 'home']);
$router->get('/login', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/register', [AuthController::class, 'showRegister']);
$router->post('/register', [AuthController::class, 'register']);
$router->get('/logout', [AuthController::class, 'logout']);

$router->get('/dashboard', [DashboardController::class, 'index']);

$router->get('/admin/users', [AdminController::class, 'users']);
$router->post('/admin/users/approve', [AdminController::class, 'approveUser']);
$router->get('/admin/books', [AdminController::class, 'books']);
$router->post('/admin/books/save', [AdminController::class, 'saveBook']);
$router->post('/admin/books/delete', [AdminController::class, 'deleteBook']);
$router->get('/admin/reports', [AdminController::class, 'reports']);

$router->post('/librarian/borrow/confirm', [LibrarianController::class, 'confirmBorrow']);
$router->post('/librarian/return/confirm', [LibrarianController::class, 'confirmReturn']);
$router->get('/librarian/penalties', [LibrarianController::class, 'penalties']);

$router->get('/opac', [OpacController::class, 'search']);
$router->post('/opac/borrow-request', [OpacController::class, 'requestBorrow']);
