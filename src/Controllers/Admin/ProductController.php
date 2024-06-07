<?php

namespace LuxChill\Controllers\Admin;

use LuxChill\Commons\Controller;
use LuxChill\Interfaces\InterfaceCrudController;
use LuxChill\Models\Category;
use LuxChill\Models\Product;
use Rakit\Validation\Rules\ImageFileRule;
use Rakit\Validation\Rules\ImageFormatRule;

class ProductController extends Controller implements InterfaceCrudController
{
	private string $folder = 'products.';
	private Product $product;
	private Category $category;

	public function __construct()
	{
		parent::__construct();
		$this->product = new Product();
		$this->category = new Category();
		$this->registerValidators();
	}

	public function registerValidators()
	{
		$this->validator->addValidator('image_files', new ImageFileRule());
		$this->validator->addValidator('image_format', new ImageFormatRule());
	}

	public function index()
	{
		$page = $_GET['page'] ?? 1;
		[$products, $totalPage] = $this->product->paginate($page, 1);

//		echo "<pre>";
//		print_r($products);
//		echo "</pre>";

		$data = [
			'products' => $products,
			'totalPage' => $totalPage,
			'page' => $page
		];

		return $this->renderAdmin($this->folder . __FUNCTION__, $data);
	}

	public function create()
	{
		$data = [
			'categories' => $this->category->getAll('*')
		];
		return $this->renderAdmin($this->folder . __FUNCTION__, $data);
	}

	public function store()
	{
		$validation = $this->validator->make($_POST + $_FILES, [
			'name' => 'required',
			'price' => 'required|numeric',
			'quantity' => 'required|numeric',
			'images' => 'image_files|image_format',
		]);

		$validation->validate();

		if ($validation->fails()) {
			$_SESSION['errors'] = $validation->errors()->firstOfAll();
			header('location: ' . routeAdmin('products/create'));
		} else {

			$data = [
				'name' => $_POST['name'],
				'slug' => createSlug($_POST['name']),
				'image' => upload_multifile($_FILES['images']),
				'category_id' => $_POST['category'],
				'price' => $_POST['price'],
				'quantity' => $_POST['quantity'],
				'sku' => 'CBD' . time(),
				'status' => $_POST['status'],
				'type' => $_POST['type']
			];
			// Nếu type == 1 <==> sale. Tự động giảm 20%
			if ($_POST['type'] == 1) {
				$data['price_offer'] = handleSalePrice($_POST['price']);
			}

			$this->product->insert($data);
			setToastr('Create product success', 'success');
			header('location: ' . routeAdmin('products'));
		}
	}

	public function show($id)
	{
		echo "Show product Id = " . $id;
//		return $this->renderAdmin($this->folder . __FUNCTION__);
	}

	public function edit($id)
	{
		$data = [
			'categories' => $this->category->getAll("*"),
			'product' => $this->product->getOne($id)
		];
		return $this->renderAdmin($this->folder . __FUNCTION__, $data);
	}

	public function update($id)
	{

	}

	public function delete($id)
	{

	}

	public function setMessagesValidate()
	{
		$this->validator->setMessages([
			'name:required' => 'Vui lòng nhập name product 🤬',
			'price:required' => 'Vui lòng nhập price product 🤬',
			'quantity:required' => 'Vui lòng nhập qty product 🤬',
			'image:required' => 'Vui lòng tải image 🤬',
//			'descShort:required' => 'Vui long nhap descShort 🤬',
//			'descLong:required' => 'Vui long nhap descLong 🤬',
			'images:image_files' => 'Upload ít nhất một ảnh lên. 🤬',
			'images:image_format' => "Yêu cầu upload đúng định dạng ảnh: png , jpeg, jpg, webp 🤬",
			'price:numeric' => "Price phải là số",
			'quantity:numeric' => "Quantity phải là số",
		]);
	}
}