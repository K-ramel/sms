<?php

class AuthController extends Controller
{
    private User $userModel;
    private AuditLog $auditLog;

    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->auditLog = $this->model('AuditLog');
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                ];

                $this->auditLog->create(['user_id' => $user['id'], 'action' => 'User logged in']);
                $this->routeByRole($user['role']);
            }

            $_SESSION['flash_error'] = 'Invalid login credentials.';
        }

        $this->view('auth/login');
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => trim($_POST['name'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'password' => password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT),
                'role' => $_POST['role'] ?? 'student',
            ];

            if ($this->userModel->create($data)) {
                $_SESSION['flash_success'] = 'Account created successfully. Please log in.';
                $this->redirect('auth/login');
            }

            $_SESSION['flash_error'] = 'Unable to register user.';
        }

        $this->view('auth/register');
    }

    public function logout(): void
    {
        if (isset($_SESSION['user'])) {
            $this->auditLog->create(['user_id' => $_SESSION['user']['id'], 'action' => 'User logged out']);
        }

        session_destroy();
        $this->redirect('auth/login');
    }

    private function routeByRole(string $role): void
    {
        $map = [
            'admin' => 'admin/dashboard',
            'librarian' => 'librarian/dashboard',
            'student' => 'library/dashboard',
            'teacher' => 'library/dashboard',
        ];

        $this->redirect($map[$role] ?? 'library/dashboard');
    }
}
