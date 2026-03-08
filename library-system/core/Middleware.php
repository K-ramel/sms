<?php

namespace Core;

class Middleware
{
    public static function auth(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /library-system/public/login');
            exit;
        }
    }

    public static function role(array $roles): void
    {
        self::auth();

        $userRole = $_SESSION['user']['role'] ?? null;
        if (!in_array($userRole, $roles, true)) {
            http_response_code(403);
            echo 'Access denied.';
            exit;
        }
    }
}
