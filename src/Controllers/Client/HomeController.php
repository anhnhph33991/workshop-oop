<?php

namespace LuxChill\Controllers\Client;

use LuxChill\Commons\Controller;
use LuxChill\Models\User;

class HomeController extends Controller
{
	private User $user;
	public function __construct()
	{
		$this->user = new User();
	}
	public function index()
	{
		return $this->renderClient('home');
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
