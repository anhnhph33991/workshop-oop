<?php

namespace LuxChill\Controllers\Admin;

use LuxChill\Commons\Controller;
use LuxChill\Interfaces\InterfaceCrudController;
use LuxChill\Models\Category;

class CategoryController extends Controller implements InterfaceCrudController
{
	private string $folder = 'categories.';
	private Category $category;

	public function __construct()
	{
		$this->category = new Category();
		parent::__construct();
	}

	public function index($page = 1)
	{
		$page = $_GET['page'] ?? 1;
		[$categories, $totalPage] = $this->category->paginate($page);
		$data = [
			'categories' => $categories,
			'page' => $page,
			'totalPage' => $totalPage
		];
		return $this->renderAdmin($this->folder . __FUNCTION__, $data);
	}

	public function create()
	{
		return $this->renderAdmin($this->folder . __FUNCTION__);
	}

	public function store()
	{
		$validation = $this->validator->make($_POST + $_FILES, [
			'name' => 'required',
			'image' => 'required|uploaded_file:0,2M,png,jpeg,webp'
		]);

		$validation->validate();

		if ($validation->fails()) {
			$_SESSION['errors'] = $validation->errors()->firstOfAll();
			header('location: ' . routeAdmin('categories/create'));
			exit;
		} else {
			$data = [
				'name' => $_POST['name'],
				'slug' => createSlug($_POST['name']),
				'image' => upload_file($_FILES['image']),
			];

			$this->category->insert($data);
			setToastr('Create category success', 'success');
			header('location: ' . routeAdmin('categories'));
		}
	}

	public function show($id)
	{
		$data = [
			'category' => $this->category->getOne($id)
		];
		return $this->renderAdmin($this->folder . __FUNCTION__, $data);
	}

	public function edit($id)
	{
		$data = [
			'category' => $this->category->getOne($id)
		];
		return $this->renderAdmin($this->folder . __FUNCTION__, $data);
	}

	public function update($id)
	{
		$category = $this->category->getOne($id);

		$validation = $this->validator->make($_POST + $_FILES, [
			'name' => 'required',
			'image' => 'uploaded_file:0,2M,png,jpeg,webp'
		]);

		$validation->validate();

		if ($validation->fails()) {
			$_SESSION['errors'] = $validation->errors()->firstOfAll();
			header('location: ' . routeAdmin("categories/$id/edit"));
		} else {
			$image = $_FILES['image']['error'] == UPLOAD_ERR_OK ? upload_file($_FILES['image']) : $category['image'];
			$status = $_POST['status'] ?? $category['status'];

			$data = [
				'name' => $_POST['name'],
				'status' => $status,
				'image' => $image,
				'updated_at' => getDateTime()
			];

			$this->category->update($id, $data);

			if ($image != $category['image'] && file_exists($category['image'])) {
				unlink($category['image']);
			}

			setToastr('Update category success', 'success');
			header('location: ' . routeAdmin("categories/$id/edit"));
		}
	}

	public function delete($id)
	{
		echo $id;
//		$this->category->delete($id);
//		setToastr('Delete Category Success', 'success');
//		header('location: ' . routeAdmin('categories'));
	}
}
