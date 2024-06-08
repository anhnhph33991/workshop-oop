<?php

namespace LuxChill\Controllers\Client;

use LuxChill\Commons\Controller;
use LuxChill\Models\User;
use Rakit\Validation\Rules\UniqueEmailRule;

class AuthController extends Controller
{
	private string $folder = 'auth.';
	private User $user;

	public function __construct()
	{
		parent::__construct();
		$this->user = new User();
	}

	public function login()
	{
		middleware_user_auth();
//		setToastr('add success', 'success');
		return $this->renderClient($this->folder . __FUNCTION__);
	}

	public function handleLogin()
	{
		middleware_user_auth();
		$this->validator->addValidator('uniqueEmail', new UniqueEmailRule());
		$validation = $this->validator->make($_POST, [
			'email' => 'required|email',
			'password' => 'required'
		]);

		$validation->validate();

		if ($validation->fails()) {
			$_SESSION['errors'] = $validation->errors()->firstOfAll();
			header('location: ' . routeClient('login'));
			exit();
		} else {
			echo "success";

			$user = $this->user->getByEmail($_POST['email']);

			if(empty($user)){
				$_SESSION['errors']['email'] = 'Email k ton tai';
				setToastr('Login failed', 'error');
				header('location: ' . routeClient('login'));
				exit();
			}

			echo "</br>";

			middleware_login($_POST['password'], $user);


//			$data = [
//				'email' => $_POST['email'],
//				'password' => $_POST['password'],
//			];

			echo "<pre>";
			print_r($user);
			echo "</pre>";
		}
	}

	public function register()
	{
		middleware_user_auth();
		return $this->renderClient($this->folder . __FUNCTION__);
	}

	public function handleRegister()
	{
		middleware_user_auth();
		$this->validator->addValidator('uniqueEmail', new UniqueEmailRule());
		$validation = $this->validator->make($_POST, [
			'username' => 'required',
			'email' => 'required|email|uniqueEmail',
			'password' => 'required|min:5'
		]);


		$validation->validate();

		if ($validation->fails()) {
			$_SESSION['errors'] = $validation->errors()->firstOfAll();
			setToastr('Register account failed', 'error');
			header('location: ' . routeClient('register'));
		} else {
			$data = [
				'username' => $_POST['username'],
				'email' => $_POST['email'],
				'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
			];
			
			$this->user->insert($data);
			setToastr('Register account success', 'success');
			header('location: ' . routeClient('login'));
		}
	}

	public function logout()
	{
		unset($_SESSION['user']);
		setToastr('Login success', 'success');
		header('location: ' . routeClient('login'));
		exit();
	}
}