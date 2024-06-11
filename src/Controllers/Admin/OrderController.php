<?php

namespace LuxChill\Controllers\Admin;

use LuxChill\Commons\Controller;
use LuxChill\Interfaces\InterfaceCrudController;
use LuxChill\Models\Order;
use LuxChill\Models\OrderDetail;
use LuxChill\Models\Product;

class OrderController extends Controller implements InterfaceCrudController
{
	private string $folder = 'orders.';
	private OrderDetail $orderDetail;
	private Order $order;
	private Product $product;

	public function __construct()
	{
		$this->order = new Order();
		$this->orderDetail = new OrderDetail();
		$this->product = new Product();
	}

	public function index()
	{

//		$selectAllOrderDetail  = $this->orderDetail->getAll("*");
		$page = $_GET['page'] ?? 1;
		[$orders, $totalPage] = $this->orderDetail->paginateAbc($page, 10);
		
//		echo "<pre>";
//		print_r($orders);
//		echo "</pre>";
//		die;

	$data = [
		'orders' => $orders,
		'totalPage' => $totalPage,
		'page' => $page
	];

		return $this->renderAdmin($this->folder . __FUNCTION__, $data);
	}

	public function create()
	{
		return $this->renderAdmin($this->folder . __FUNCTION__);
	}

	public function store()
	{

	}

	public function show($id)
	{
		return $this->renderAdmin($this->folder . __FUNCTION__);
	}

	public function edit($id)
	{
		return $this->renderAdmin($this->folder . __FUNCTION__);
	}

	public function update($id)
	{

	}

	public function delete($id)
	{

	}
}