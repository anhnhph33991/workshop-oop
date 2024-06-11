<?php

namespace LuxChill\Controllers\Client;

use LuxChill\Commons\Controller;
use LuxChill\Models\Cart;
use LuxChill\Models\CartDetail;
use LuxChill\Models\Category;
use LuxChill\Models\Comment;
use LuxChill\Models\Product;

class ShopController extends Controller
{
	private Product $product;
	private Category $categories;
	private CartDetail $cartDetail;
	private Cart $cart;
	private Comment $comment;

	public function __construct()
	{
		parent::__construct();
		$this->product = new Product();
		$this->categories = new Category();
		$this->cartDetail = new CartDetail();
		$this->cart = new Cart();
		$this->comment = new Comment();
	}

	public function index()
	{
		$category = $_GET['c'] ?? null;
		$cateId = $_GET['id'] ?? null;
		$page = $_GET['p'] ?? 1;
		$categories = $this->categories->getAll('*');

		if (isset($category) && isset($cateId)) {
			$url = "shops?c={$category}&id={$cateId}&p=";
			[$products, $totalPage] = $this->product->paginateCategory($cateId, $page, 1);
		} else {
			$url = 'shops?p=';
			[$products, $totalPage] = $this->product->paginate($page, 2, 1);
		}

		$data = [
			'products' => $products,
			'page' => $page,
			'totalPage' => $totalPage,
			'category' => $category,
			'categories' => $categories,
			'url' => $url
		];

		return $this->renderClient('shop', $data);
	}

	public function detail($slug)
	{
		$product = $this->product->getBySlug($slug);
		$comments =  $this->comment->selectAll($product['p_id']);

		echo "<pre>";
		print_r($comments);
		echo "</pre>";

		$data = [
			'product' => $product,
			'images' => explode(',', $product['p_image']),
			'comments' => $comments
		];
		return $this->renderClient('productDetail', $data);
	}

	public function comment($slug)
	{
		$data = [
			'product' => $this->product->getBySlug($slug)
		];
		return $this->renderClient('comment', $data);
	}

	public function handleComment($slug)
	{
		$product = $this->product->getBySlug($slug);
		$validation = $this->validator->make($_POST, [
			'content' => 'required|max:255'
		]);

		$validation->validate();
		if($validation->fails()){
			$_SESSION['errors']  = $validation->errors()->firstOfAll();
			header("location: " . routeClient("/shop/{$slug}/comment"));
			exit();
		}else{

			$data = [
				'content' => $_POST['content'],
				'user_id' => $_SESSION['user']['id'],
				'product_id' => $product['p_id']
			];

			$this->comment->insert($data);
			setToastr('Comment Success', 'success');
			header('location: ' . routeClient("shop/{$slug}"));
		}
	}
}