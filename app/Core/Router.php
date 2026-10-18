<?php
declare(strict_types=1);

namespace App\Core;

class Router {
    public function dispatch(): void {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = trim($uri, '/');
        
        $controllerName = 'Home';
        $actionName = 'index';

        $parts = explode('/', $uri);
        if (!empty($parts[0]) && $parts[0] !== 'public' && $parts[0] !== 'sae2026') {
            $controllerName = ucfirst($parts[0]);
        }
        if (!empty($parts[1])) {
            $actionName = $parts[1];
        }

        $controllerClass = "App\\Controllers\\" . $controllerName . "Controller";

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            if (method_exists($controller, $actionName)) {
                $controller->$actionName();
                return;
            }
        }

        http_response_code(404);
        echo "404 - Page non trouvée";
    }
}
