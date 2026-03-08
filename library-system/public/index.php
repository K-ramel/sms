<?php

declare(strict_types=1);

session_start();

require __DIR__ . '/../vendor/autoload.php';

$appConfig = require __DIR__ . '/../config/app.php';
date_default_timezone_set($appConfig['timezone']);

$app = new Core\App();
$app->run();
