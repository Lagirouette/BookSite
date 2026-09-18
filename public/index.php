<?php
// Front controller - point d'entrée public
// Charge les autoloaders

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/router/Autoloader.php';
\App\router\Autoloader::register();

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (strpos($path, '/assets/') === 0) {
	$assetPath = __DIR__ . '/..' . $path;

	if (is_file($assetPath)) {
		$mimeTypes = [
			'css' => 'text/css; charset=UTF-8',
			'js' => 'application/javascript; charset=UTF-8',
			'png' => 'image/png',
			'jpg' => 'image/jpeg',
			'jpeg' => 'image/jpeg',
			'webp' => 'image/webp',
		];
		$extension = strtolower(pathinfo($assetPath, PATHINFO_EXTENSION));
		header('Content-Type: ' . ($mimeTypes[$extension] ?? 'application/octet-stream'));
		readfile($assetPath);
		exit;
	}
}

$router = new \App\router\Router();
$router->dispatch($_SERVER['REQUEST_URI']);