<?php

namespace LuxChill\Controllers\Client;

use LuxChill\Commons\Controller;
use LuxChill\Models\User;

class AccountController extends Controller
{
	private User $user;
	public function __construct()
	{
		$this->user = new User();
	}

	public function index()
	{
		$user = $this->user->getOne($_SESSION['user']['id']);
		
		echo "<pre>";
		print_r($user);
		echo "</pre>";
	}
}