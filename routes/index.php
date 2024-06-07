<?php

$router = new \Bramus\Router\Router();

require_once __DIR__ . '/client.php';
require_once __DIR__ . '/admin.php';

$router->set404(function() {
	header('HTTP/1.1 404 Not Found');
	echo "404 not found";
});

$router->run();