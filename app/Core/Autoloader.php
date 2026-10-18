<?php
declare(strict_types=1);

namespace App\Core;

class Autoloader {
    private const PREFIX = 'App\\';

    public static function register(): void {
        spl_autoload_register(function (string $class): void {
            $len = strlen(self::PREFIX);
            if (strncmp(self::PREFIX, $class, $len) !== 0) {
                return;
            }
            $relativeClass = substr($class, $len);
            $file = __DIR__ . '/../' . str_replace('\\', '/', $relativeClass) . '.php';

            if (file_exists($file)) {
                require $file;
            }
        });
    }
}
