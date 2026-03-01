<?php

declare(strict_types=1);

use App\Core\LanGuard;
use App\Core\Router;

session_start();
LanGuard::enforce();

spl_autoload_register(static function (string $class): void {
    $prefix = 'App\\';
    if (str_starts_with($class, $prefix)) {
        $path = __DIR__ . '/../app/' . str_replace('App\\', '', $class) . '.php';
        $path = str_replace('\\', '/', $path);
        if (file_exists($path)) {
            require $path;
        }
    }
});

$router = new Router();
require __DIR__ . '/../app/routes.php';
$router->resolve($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
