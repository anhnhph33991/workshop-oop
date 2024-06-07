<?php

/** @var TYPE_NAME $router */

use LuxChill\Controllers\Admin\CategoryController;
use LuxChill\Controllers\Admin\CommentController;
use LuxChill\Controllers\Admin\DashboardController;
use LuxChill\Controllers\Admin\OrderController;
use LuxChill\Controllers\Admin\ProductController;
use LuxChill\Controllers\Admin\UserController;
use LuxChill\Controllers\Admin\VoucherController;

// $router->before('GET|POST', '/admin/*.*', function () {
// 	middleware_auth();
// });

$router->mount('/admin', function () use ($router) {
	// route dashboard
	$router->get('/', 				DashboardController::class 	. '@index');
	// route categories
	$router->mount('/categories', function () use ($router) {
		$router->get('/', 	   		CategoryController::class 	. '@index');
		$router->get('/create', 		CategoryController::class 	. '@create');
		$router->post('/store',		CategoryController::class 	. '@store');
		$router->get('/{id}/show', 	CategoryController::class 	. '@show');
		$router->get('/{id}/edit', 	CategoryController::class 	. '@edit');
		$router->post('/{id}/update', 		CategoryController::class 	. '@update');
		$router->get('/{id}/delete', 	CategoryController::class 	. '@delete');
		$router->get('/{id}', 		CategoryController::class 	. '@index');
	});
	// route comments
	$router->mount('/comments', function () use ($router) {
		$router->get('/', 			CommentController::class 	. '@index');
		$router->get('/create', 		CommentController::class 	. '@create');
		$router->post('/store', 		CommentController::class 	. '@store');
		$router->get('/{id}/show', 	CommentController::class 	. '@show');
		$router->get('/{id}/edit', 	CommentController::class 	. '@edit');
		$router->get('/{id}', 		CommentController::class 	. '@update');
		$router->delete('/{id}', 	CommentController::class 	. '@delete');
		$router->get('/{id}', 		CommentController::class 	. '@index');
	});
	// route orders
	$router->mount('/orders', function () use ($router) {
		$router->get('/', 			OrderController::class 		. '@index');
		$router->get('/create', 		OrderController::class 		. '@create');
		$router->post('/store', 		OrderController::class 		. '@store');
		$router->get('/{id}/show', 	OrderController::class 		. '@show');
		$router->get('/{id}/edit', 	OrderController::class 		. '@edit');
		$router->post('/{id}', 		OrderController::class 		. '@update');
		$router->get('/{id}', 	OrderController::class 		. '@delete');
		$router->get('/{id}', 		OrderController::class 		. '@index');
	});
	// route products
	$router->mount('/products', function () use ($router) {
		$router->get('/', 			ProductController::class 	. '@index');
		$router->get('/create', 		ProductController::class 	. '@create');
		$router->post('/store', 		ProductController::class 	. '@store');
		$router->get('/{id}/show', 	ProductController::class 	. '@show');
		$router->get('/{id}/edit', 	ProductController::class 	. '@edit');
		$router->post('/{id}/update', 		ProductController::class 	. '@update');
		$router->get('/{id}/delete', 	ProductController::class 	. '@delete');
		$router->get('/{id}', 		ProductController::class 	. '@show');
	});
	// route users
	$router->mount('/users', function () use ($router) {
		$router->get('/', 			UserController::class 		. '@index');
		$router->get('/create', 		UserController::class 		. '@create');
		$router->post('/store', 		UserController::class 		. '@store');
//		$router->get('/{id}/show', 	UserController::class 		. '@show');
		$router->get('/{id}/edit', 	UserController::class 		. '@edit');
		$router->post('/{id}/update', 		UserController::class 		. '@update');
		$router->get('/{id}/delete', 	UserController::class 		. '@delete');
		$router->get('/{id}', 		UserController::class 		. '@show');
	});
	// route vouchers
	$router->mount('/vouchers', function () use ($router) {
		$router->get('/', 			VoucherController::class 	. '@index');
		$router->get('/create', 		VoucherController::class 	. '@create');
		$router->post('/store', 		VoucherController::class 	. '@store');
		$router->get('/{id}/show', 	VoucherController::class 	. '@show');
		$router->get('/{id}/edit', 	VoucherController::class 	. '@edit');
		$router->post('/{id}', 		VoucherController::class 	. '@update');
		$router->get('/{id}', 	VoucherController::class 	. '@delete');
		$router->get('/{id}', 		VoucherController::class 	. '@index');
	});
});
