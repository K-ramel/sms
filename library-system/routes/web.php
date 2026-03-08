<?php

/** @var \Core\Router $router */

$router->get('/', 'AuthController@login');
$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@authenticate');
$router->get('/register', 'AuthController@register');
$router->post('/register', 'AuthController@store');
$router->get('/logout', 'AuthController@logout');

$router->get('/dashboard', 'DashboardController@index');

$router->get('/books', 'BookController@index');
$router->post('/books/store', 'BookController@store');
$router->post('/books/update', 'BookController@update');
$router->post('/books/delete', 'BookController@delete');

$router->get('/opac', 'BookController@opac');
$router->post('/borrow/request', 'BorrowController@request');
$router->get('/borrow', 'BorrowController@index');
$router->post('/borrow/confirm', 'BorrowController@confirm');

$router->get('/return', 'ReturnController@index');
$router->post('/return/process', 'ReturnController@process');

$router->get('/admin/users', 'AdminController@users');
$router->post('/admin/users/status', 'AdminController@updateUserStatus');
$router->get('/admin/reports', 'AdminController@reports');

$router->get('/librarian/dashboard', 'LibrarianController@dashboard');

$router->get('/student/history', 'BorrowController@history');
$router->get('/teacher/history', 'BorrowController@history');
