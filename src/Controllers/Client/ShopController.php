<?php

namespace LuxChill\Controllers\Client;

use LuxChill\Commons\Controller;
use LuxChill\Models\Category;
use LuxChill\Models\Product;

class ShopController extends Controller
{
	private Product $product;
	private Category $categories;
	public function __construct()
	{
		$this->product = new Product();
		$this->categories = new Category();
	}

	public function index()
	{
		$category = $_GET['c'] ?? null;
		$cateId = $_GET['id'] ?? null;
		$page = $_GET['p'] ?? 1;
		$categories = $this->categories->getAll('*');

//		$url = 'shops?p=';
//		[$products, $totalPage] = $this->product->paginate($page, 1);
//
//		if(isset($category) && isset($cateId)){
//			$url = "shops?c={$category}&id={$cateId}&p=";
//			[$products, $totalPage] = $this->product->paginateCategory($cateId,$page);
//		}

		if(isset($category) && isset($cateId)){
			$url = "shops?c={$category}&id={$cateId}&p=";
			[$products, $totalPage] = $this->product->paginateCategory($cateId,$page, 1);
		}else{
			$url = 'shops?p=';
			[$products, $totalPage] = $this->product->paginate($page, 2, 1);
		}
		
//		echo "<pre>";
//		print_r($products);
//		echo "</pre>";

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

	public function detail($id)
	{
		$product = $this->product->getOne($id);
		$data = [
			'product' => $product
		];
		return $this->renderClient('productDetail');
	}
}