<?php

/** @var TYPE_NAME $router */

use LuxChill\Controllers\Admin\CategoryController;
use LuxChill\Controllers\Admin\CommentController;
use LuxChill\Controllers\Admin\DashboardController;
use LuxChill\Controllers\Admin\OrderController;
use LuxChill\Controllers\Admin\ProductController;
use LuxChill\Controllers\Admin\UserController;
use LuxChill\Controllers\Admin\VoucherController;

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
		$router->put('/{id}', 		CategoryController::class 	. '@update');
		$router->delete('/{id}', 	CategoryController::class 	. '@delete');
		$router->get('/{id}', 		CategoryController::class 	. '@index');
	});
	// route comments
	$router->mount('/comments', function () use ($router) {
		$router->get('/', 			CommentController::class 	. '@index');
		$router->get('/create', 		CommentController::class 	. '@create');
		$router->post('/store', 		CommentController::class 	. '@store');
		$router->get('/{id}/show', 	CommentController::class 	. '@show');
		$router->get('/{id}/edit', 	CommentController::class 	. '@edit');
		$router->put('/{id}', 		CommentController::class 	. '@update');
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
		$router->put('/{id}', 		OrderController::class 		. '@update');
		$router->delete('/{id}', 	OrderController::class 		. '@delete');
		$router->get('/{id}', 		OrderController::class 		. '@index');
	});
	// route products
	$router->mount('/products', function () use ($router) {
		$router->get('/', 			ProductController::class 	. '@index');
		$router->get('/create', 		ProductController::class 	. '@create');
		$router->post('/store', 		ProductController::class 	. '@store');
		$router->get('/{id}/show', 	ProductController::class 	. '@show');
		$router->get('/{id}/edit', 	ProductController::class 	. '@edit');
		$router->put('/{id}', 		ProductController::class 	. '@update');
		$router->delete('/{id}', 	ProductController::class 	. '@delete');
		$router->get('/{id}', 		ProductController::class 	. '@index');
	});
	// route users
	$router->mount('/users', function () use ($router) {
		$router->get('/', 			UserController::class 		. '@index');
		$router->get('/create', 		UserController::class 		. '@create');
		$router->post('/store', 		UserController::class 		. '@store');
		$router->get('/{id}/show', 	UserController::class 		. '@show');
		$router->get('/{id}/edit', 	UserController::class 		. '@edit');
		$router->put('/{id}', 		UserController::class 		. '@update');
		$router->delete('/{id}', 	UserController::class 		. '@delete');
		$router->get('/{id}', 		UserController::class 		. '@index');
	});
	// route vouchers
	$router->mount('/vouchers', function () use ($router) {
		$router->get('/', 			VoucherController::class 	. '@index');
		$router->get('/create', 		VoucherController::class 	. '@create');
		$router->post('/store', 		VoucherController::class 	. '@store');
		$router->get('/{id}/show', 	VoucherController::class 	. '@show');
		$router->get('/{id}/edit', 	VoucherController::class 	. '@edit');
		$router->put('/{id}', 		VoucherController::class 	. '@update');
		$router->delete('/{id}', 	VoucherController::class 	. '@delete');
		$router->get('/{id}', 		VoucherController::class 	. '@index');
	});
});