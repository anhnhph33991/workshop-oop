<?php

namespace LuxChill\Controllers\Client;

use LuxChill\Commons\Controller;
use LuxChill\Models\Cart;
use LuxChill\Models\CartDetail;
use LuxChill\Models\Category;
use LuxChill\Models\Product;

class ShopController extends Controller
{
	private Product $product;
	private Category $categories;
	private CartDetail $cartDetail;
	private Cart $cart;

	public function __construct()
	{
		$this->product = new Product();
		$this->categories = new Category();
		$this->cartDetail = new CartDetail();
		$this->cart = new Cart();
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

		$data = [
			'product' => $product,
			'images' => explode(',', $product['p_image'])
		];
		return $this->renderClient('productDetail', $data);
	}
}