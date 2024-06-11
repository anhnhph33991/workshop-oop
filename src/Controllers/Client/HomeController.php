<?php

namespace LuxChill\Controllers\Client;

use LuxChill\Commons\Controller;
use LuxChill\Models\Category;
use LuxChill\Models\Product;
use LuxChill\Models\User;

class HomeController extends Controller
{
	private User $user;
	private Product $product;
	private Category $category;
	public function __construct()
	{
		$this->user = new User();
		$this->product = new Product();
		$this->category = new Category();
	}
	public function index()
	{
		$data = [
			'productTop8' => $this->product->getTop8(),
			'categories' => $this->category->getAll('*')
		];
		return $this->renderClient('home', $data);
	}

	public function login()
	{
		return $this->renderClient('auth.login');
	}

	public function register()
	{
		return $this->renderClient('auth.register');
	}
}
