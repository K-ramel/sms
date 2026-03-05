<?php

session_start();

require_once dirname(__DIR__) . '/config/config.php';

spl_autoload_register(function ($className) {
    $paths = [
        APPROOT . '/app/core/' . $className . '.php',
        APPROOT . '/app/controllers/' . $className . '.php',
        APPROOT . '/app/models/' . $className . '.php',
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

$app = new App();
