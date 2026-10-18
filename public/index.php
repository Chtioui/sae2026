<?php
declare(strict_types=1);

require_once __DIR__ . '/../app/Core/Autoloader.php';
App\Core\Autoloader::register();

$router = new App\Core\Router();
$router->dispatch();
