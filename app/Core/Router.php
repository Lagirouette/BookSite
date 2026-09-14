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

        if (preg_match('#^/books/(\d+)$#', $path, $matches)) {
            $controller = new \App\Controllers\BookController();
            $controller->show((int) $matches[1]);
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

        $controller = new \App\Controllers\ErrorController();
        $controller->notFound();
    }
}
