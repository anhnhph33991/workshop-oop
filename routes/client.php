<?php

/** @var TYPE_NAME $router */

use LuxChill\Controllers\Client\AccountController;
use LuxChill\Controllers\Client\AuthController;
use LuxChill\Controllers\Client\CartController;
use LuxChill\Controllers\Client\CheckOutController;
use LuxChill\Controllers\Client\HomeController;
use LuxChill\Controllers\Client\Orders;
use LuxChill\Controllers\Client\ShopController;

$router->get('/', HomeController::class . '@index');
$router->get('/about', function () {
    echo "Page about";
});

$router->get('shops', ShopController::class . '@index');
//$router->get('shop/{id}', ShopController::class . '@detail');
$router->get('shop/{slug}', ShopController::class . '@detail');

$router->get('/products', function () {
    echo "Page products";
    $page = $_GET['page'] ?? 1;
});

$router->get('/products/{id}', function ($id) {
    echo "Page product detail = " . $id;
});

$router->get('/cart', CartController::class . '@index');
$router->post('/cart/add', CartController::class . '@add');
$router->post('/cart/update', CartController::class . '@update');
$router->get('/cart/delete/{id}', CartController::class . '@delete');


$router->get('/check-out', CheckOutController::class . '@index');

$router->get('/confirm', CheckOutController::class . '@confirm');


$router->get('/track-order', Orders::class . '@check');

$router->get('/my-orders', function () {
    echo "Page my-orders";
});

$router->get('/account', AccountController::class . '@index');

$router->get('/profile', function () {
    echo "Page profile";
});

// auth route

$router->get('/login', AuthController::class . '@login');

$router->post('/handle-login', AuthController::class . '@handleLogin');

$router->get('/register', AuthController::class . '@register');

$router->post('/handle-register', AuthController::class . '@handleRegister');

$router->get('/logout', AuthController::class . '@logout');


$router->get('/forgot-password', function () {
    echo "Handle forgot-password";
});
