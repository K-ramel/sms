<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function home(): void
    {
        $this->render('shared/home', ['user' => Auth::user()]);
    }

    public function showLogin(): void
    {
        $this->render('auth/login');
    }

    public function login(): void
    {
        $userModel = new User();
        $user = $userModel->findByEmail((string) $this->input('email'));

        if (!$user || !password_verify((string) $this->input('password'), $user['password'])) {
            $this->render('auth/login', ['error' => 'Invalid credentials']);
            return;
        }

        if ($user['status'] !== 'Active') {
            $this->render('auth/login', ['error' => 'Your account is not active yet.']);
            return;
        }

        Auth::login($user);
        $this->redirect('/dashboard');
    }

    public function showRegister(): void
    {
        $this->render('auth/register');
    }

    public function register(): void
    {
        $data = [
            'school_id' => (string) $this->input('school_id'),
            'fullname' => (string) $this->input('fullname'),
            'email' => (string) $this->input('email'),
            'password' => password_hash((string) $this->input('password'), PASSWORD_BCRYPT),
            'role' => (string) $this->input('role'),
            'department' => (string) $this->input('department'),
            'status' => 'Pending',
        ];

        $userModel = new User();
        $userModel->create($data);
        $this->render('auth/register', ['success' => 'Registration submitted. Wait for admin approval.']);
    }

    public function logout(): void
    {
        Auth::logout();
        $this->redirect('/login');
    }
}
