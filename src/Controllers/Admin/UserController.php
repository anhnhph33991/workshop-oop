<?php

namespace LuxChill\Controllers\Admin;

use LuxChill\Commons\Controller;
use LuxChill\Commons\Helper;
use LuxChill\Interfaces\InterfaceCrudController;
use LuxChill\Models\User;
use Rakit\Validation\Rules\UniqueEmailRule;

class UserController extends Controller implements InterfaceCrudController
{
	private User $users;
	private string $folder = 'users.';

	public function __construct()
	{
		parent::__construct();
		$this->users = new User();
	}

	public function index()
	{
		$page = $_GET['page'] ?? 1;
		[$users, $totalPage] = $this->users->paginate($page, 2);
		$data = [
			'users' => $users,
			'totalPage' => $totalPage,
			'page' => $page
		];

		return $this->renderAdmin($this->folder . __FUNCTION__, $data);
	}

	public function create()
	{
		$this->renderAdmin($this->folder . __FUNCTION__);
	}

	public function store()
	{
		$this->registerValidators();
		$validation = $this->validator->make($_POST + $_FILES, [
			'username' => 'required',
			'email' => 'required|email|unique_email',
			'password' => 'required|min:5',
			'image' => 'required|uploaded_file:0,2M,png,jpeg',
			'address' => 'required',
			'phone' => 'required|digits:10',
		]);

		$validation->validate();

		if ($validation->fails()) {
			$_SESSION['errors'] = $validation->errors()->firstOfAll();
			setToastr('Create User Failed', 'error');
			header('location: ' . routeAdmin('users/create'));
			exit;
		} else {

			$data = [
				'username' => $_POST['username'],
				'email' => $_POST['email'],
				'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
				'image' => upload_file($_FILES['image']),
				'address' => $_POST['address'],
				'phone' => $_POST['phone'],
				'role' => $_POST['role']
			];

			$this->users->insert($data);
			setToastr('Create User Success', 'success');
			header('location: ' . routeAdmin('users'));
		}

	}

	public function registerValidators($ignoreId = null)
	{
		$this->validator->addValidator('unique_email', new UniqueEmailRule($ignoreId));
	}

	public function show($id)
	{
		Helper::debug($this->users->getOne($id));
		return $this->renderAdmin($this->folder . __FUNCTION__);
	}

	public function edit($id)
	{
		$data = [
			'user' => $this->users->getOne($id)
		];
		return $this->renderAdmin($this->folder . __FUNCTION__, $data);

	}

	public function update($id)
	{
		$user = $this->users->getOne($id);
		$this->registerValidators($id);
		$validation = $this->validator->make($_POST + $_FILES, [
			'username' => 'required',
			'email' => 'required|email|unique_email',
			'password' => 'min:5',
			'image' => 'uploaded_file:0,2M,png,jpeg',
			'address' => 'required',
			'phone' => 'required|digits:10'
		]);

		$validation->validate();

		if ($validation->fails()) {
			$_SESSION['errors'] = $validation->errors()->firstOfAll();
			header('location: ' . routeAdmin("users/$id/edit"));
			exit;
		} else {
			$image = $_FILES['image']['error'] == UPLOAD_ERR_OK ? upload_file($_FILES['image']) : $user['image'];
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT) ?: $user['password'];
			$role = $_POST['role'] ?? $user['role'];

			$data = [
				'username' => $_POST['username'],
				'email' => $_POST['email'],
				'password' => $password,
				'image' => $image,
				'address' => $_POST['address'],
				'phone' => $_POST['phone'],
				'role' => $role,
				'updated_at' => getDateTime()
			];

			$this->users->update($id, $data);

			if ($image != $user['image'] && file_exists($user['image'])) {
				unlink($user['image']);
			}

			setToastr('Update user success', 'success');
			header('location: ' . routeAdmin("users/$id/edit"));
			exit;
		}
	}


	public function delete($id)
	{
		$user = $this->users->getOne($id);
		$this->users->delete($id);
		if ($user['image'] && file_exists($user['image'])) {
			unlink($user['image']);
		}

		setToastr('Delete user success', 'success');
		header('location: ' . routeAdmin("users"));
	}
}