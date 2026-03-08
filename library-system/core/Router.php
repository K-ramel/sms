<?php

namespace Core;

class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function get(string $uri, string $action): void
    {
        $this->routes['GET'][$this->normalize($uri)] = $action;
    }

    public function post(string $uri, string $action): void
    {
        $this->routes['POST'][$this->normalize($uri)] = $action;
    }

    public function dispatch(string $method, string $uri): void
    {
        $uri = $this->normalize($uri);
        $action = $this->routes[$method][$uri] ?? null;

        if (!$action) {
            http_response_code(404);
            echo 'Route not found.';
            return;
        }

        [$controllerName, $methodName] = explode('@', $action);
        $className = "App\\Controllers\\{$controllerName}";

        if (!class_exists($className)) {
            http_response_code(500);
            echo 'Controller not found.';
            return;
        }

        $controller = new $className();

        if (!method_exists($controller, $methodName)) {
            http_response_code(500);
            echo 'Method not found.';
            return;
        }

        $controller->{$methodName}();
    }

    private function normalize(string $uri): string
    {
        $path = parse_url($uri, PHP_URL_PATH) ?? '/';
        $path = trim($path, '/');

        return $path === '' ? '/' : '/' . $path;
    }
}
