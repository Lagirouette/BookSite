<?php
namespace App\Core;

class Autoloader
{
    // Enregistre l'autoload simple
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $prefix = 'App\\';
            if (strpos($class, $prefix) !== 0) {
                return;
            }
            $relative = substr($class, strlen($prefix));
            $path = __DIR__ . '/../' . str_replace('\\', '/', $relative) . '.php';
            if (file_exists($path)) {
                require_once $path;
            }
        });
    }
}
