<?php
declare(strict_types=1);

namespace App\Core;

class Router {
    public function dispatch(): void {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = trim($uri, '/');

        // Valeurs par défaut pour la page d'accueil
        $controllerName = 'Home';
        $actionName = 'index';

        $parts = explode('/', $uri);

        // Nettoyage de l'URI si elle contient "public" ou "index.php"
        $filteredParts = array_values(array_filter($parts, function($part) {
            return !in_array($part, ['', 'public', 'index.php']);
        }));

        if (!empty($filteredParts[0])) {
            $controllerName = ucfirst($filteredParts[0]);
        }
        if (!empty($filteredParts[1])) {
            $actionName = $filteredParts[1];
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