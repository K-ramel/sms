<?php

declare(strict_types=1);

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, array $handler): void
    {
        $this->register('GET', $path, $handler);
    }

    public function post(string $path, array $handler): void
    {
        $this->register('POST', $path, $handler);
    }

    private function register(string $method, string $path, array $handler): void
    {
        $this->routes[$method][$path] = $handler;
    }

    public function resolve(string $method, string $path): void
    {
        $path = parse_url($path, PHP_URL_PATH) ?: '/';
        $handler = $this->routes[$method][$path] ?? null;

        if ($handler === null) {
            http_response_code(404);
            echo 'Page not found';
            return;
        }

        [$class, $action] = $handler;
        $controller = new $class();
        $controller->{$action}();
    }
}
