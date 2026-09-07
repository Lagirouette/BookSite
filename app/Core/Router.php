<?php
namespace App\Core;

class Router
{
    public function dispatch(string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH);

        if ($path === '/' || $path === '/home') {
            $controller = new \App\Controllers\HomeController();
            $controller->index();
            return;
        }

        if ($path === '/books') {
            $controller = new \App\Controllers\BookController();
            $controller->index();
            return;
        }

        if ($path === '/login') {
            $controller = new \App\Controllers\LoginController();
            $controller->index();
            return;
        }

        if ($path === '/register') {
            $controller = new \App\Controllers\RegisterController();
            $controller->index();
            return;
        }

        http_response_code(404);
        echo '<h1>Page non trouvée</h1>';
    }
}
