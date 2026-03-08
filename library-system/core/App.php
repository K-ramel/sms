<?php

namespace Core;

class App
{
    public function run(): void
    {
        $router = new Router();
        require __DIR__ . '/../routes/web.php';

        $url = $_GET['url'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $router->dispatch($method, $url);
    }
}
