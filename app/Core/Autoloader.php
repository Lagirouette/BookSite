<?php
namespace App\Core;

class Autoloader
{
    public static function register(): void
    {
        spl_autoload_register(function (string $class): void {
            $prefix = 'App\\';

            if (strpos($class, $prefix) === 0) {
                $relative = substr($class, strlen($prefix));
                $path = __DIR__ . '/../' . str_replace('\\', '/', $relative) . '.php';

                if (is_file($path)) {
                    require_once $path;
                }

                return;
            }

            if (strpos($class, '\\') !== false) {
                return;
            }

            $directories = [
                __DIR__ . '/../Models/',
                __DIR__ . '/../Controllers/',
                __DIR__ . '/../Core/',
            ];

            foreach ($directories as $directory) {
                $path = $directory . $class . '.php';

                if (is_file($path)) {
                    require_once $path;
                    return;
                }
            }
        });
    }
}
