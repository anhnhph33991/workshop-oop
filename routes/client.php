<?php

/** @var TYPE_NAME $router */

use LuxChill\Controllers\Client\HomeController;

$router->get('/', HomeController::class . '@index');
$router->get('/about', function () {
    echo "Page about";
});

$router->get('/products', function () {
    echo "Page products";
    $page = $_GET['page'] ?? 1;
});

$router->get('/products/{id}', function ($id) {
    echo "Page product detail = " . $id;
});

$router->get('/cart', function () {
    echo "Page cart";
});

$router->get('/check-out', function () {
    echo "Page check-out";
});

$router->get('/track-order', function () {
    echo "Page track-order";
});

$router->get('/my-orders', function () {
    echo "Page my-orders";
});

$router->get('/account', function () {
    echo "Page account";
});

$router->get('/profile', function () {
    echo "Page profile";
});

// auth route

$router->get('/login', HomeController::class . '@login');

$router->post('/handle-login', function () {
    echo "Handle Login";
});

$router->get('/register', HomeController::class . '@register');

$router->post('/handle-register', function () {
    echo "Handle register";
});

$router->get('/forgot-password', function () {
    echo "Handle forgot-password";
});
