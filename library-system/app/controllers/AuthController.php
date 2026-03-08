<?php

namespace App\Controllers;

use Core\Controller;

class AuthController extends Controller
{
    public function login(): void
    {
        $this->view('auth/login', ['csrf' => $this->csrfToken()]);
    }

    public function register(): void
    {
        $this->view('auth/register', ['csrf' => $this->csrfToken()]);
    }

    public function store(): void
    {
        if (!$this->verifyCsrf()) {
            http_response_code(419);
            die('Invalid CSRF token.');
        }

        $name = trim($_POST['name'] ?? '');
        $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
        $studentId = trim($_POST['student_id'] ?? '');
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? 'Student';

        if (!$name || !$email || strlen($password) < 6) {
            $_SESSION['error'] = 'Please provide valid registration details.';
            $this->redirect('register');
        }

        $userModel = $this->model('User');
        if ($userModel->findByEmail($email)) {
            $_SESSION['error'] = 'Email already registered.';
            $this->redirect('register');
        }

        $userModel->create([
            'name' => $name,
            'email' => $email,
            'student_id' => $studentId,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role,
            'status' => 'Pending',
        ]);

        $_SESSION['success'] = 'Registration submitted. Wait for admin approval.';
        $this->redirect('login');
    }

    public function authenticate(): void
    {
        if (!$this->verifyCsrf()) {
            http_response_code(419);
            die('Invalid CSRF token.');
        }

        $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';

        $user = $this->model('User')->findByEmail((string)$email);

        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['error'] = 'Invalid credentials.';
            $this->redirect('login');
        }

        if ($user['status'] !== 'Approved') {
            $_SESSION['error'] = 'Your account is not approved or has been blocked.';
            $this->redirect('login');
        }

        $_SESSION['user'] = [
            'id' => (int)$user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
        ];

        $this->logAudit('login', 'User logged in');
        $this->redirect('dashboard');
    }

    public function logout(): void
    {
        if (isset($_SESSION['user'])) {
            $this->logAudit('logout', 'User logged out');
        }

        session_unset();
        session_destroy();

        header('Location: /library-system/public/login');
        exit;
    }

    private function logAudit(string $action, string $description): void
    {
        $line = sprintf("[%s] %s: %s%s", date('Y-m-d H:i:s'), $action, $description, PHP_EOL);
        file_put_contents(__DIR__ . '/../../storage/audit.log', $line, FILE_APPEND);
    }
}
