<?php
namespace App\router;

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

        if (preg_match('#^/books/(\d+)/edit$#', $path, $matches)) {
            $controller = new \App\Controllers\BookController();
            $controller->edit((int) $matches[1]);
            return;
        }

        if (preg_match('#^/books/(\d+)/delete$#', $path, $matches)) {
            $controller = new \App\Controllers\BookController();
            $controller->deleteBook((int) $matches[1]);
            return;
        }

        if (preg_match('#^/users/(\d+)$#', $path, $matches)) {
            $controller = new \App\Controllers\UserController();
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

        if ($path === '/account') {
            $controller = new \App\Controllers\AccountController();
            $controller->index();
            return;
        }

        if ($path === '/messages') {
            $controller = new \App\Controllers\MessageController();
            $controller->index();
            return;
        }

        if ($path === '/logout') {
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }
            $_SESSION = [];
            session_destroy();
            header('Location: /');
            return;
        }

        $controller = new \App\Controllers\ErrorController();
        $controller->notFound();
    }
}
