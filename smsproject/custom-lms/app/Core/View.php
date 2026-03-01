<?php

declare(strict_types=1);

namespace App\Core;

class View
{
    public static function render(string $view, array $params = [], string $layout = 'main'): void
    {
        extract($params);

        $viewFile = __DIR__ . '/../Views/' . $view . '.php';
        $layoutFile = __DIR__ . '/../Views/layouts/' . $layout . '.php';

        if (!file_exists($viewFile)) {
            throw new \RuntimeException("View {$view} not found");
        }

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        require $layoutFile;
    }
}
