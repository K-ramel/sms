<?php

declare(strict_types=1);

namespace App\Core;

class LanGuard
{
    public static function enforce(): void
    {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';

        $isLan = str_starts_with($ip, '10.')
            || str_starts_with($ip, '192.168.')
            || preg_match('/^172\.(1[6-9]|2[0-9]|3[0-1])\./', $ip)
            || $ip === '127.0.0.1'
            || $ip === '::1';

        if (!$isLan) {
            http_response_code(403);
            exit('This Library Management System is available only within the campus LAN.');
        }
    }
}
