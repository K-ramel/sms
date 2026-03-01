<?php

declare(strict_types=1);

namespace App\Core;

class Auth
{
    public static function user(): ?array
    {
        return $_SESSION['user'] ?? null;
    }

    public static function check(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function login(array $user): void
    {
        unset($user['password']);
        $_SESSION['user'] = $user;
    }

    public static function logout(): void
    {
        unset($_SESSION['user']);
        session_regenerate_id(true);
    }
}
