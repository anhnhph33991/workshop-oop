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
		parent::__construct();
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
		$order = $this->orderDetail->findOne($id);
//		echo "<pre>";
//		print_r($order);
//		echo "</pre>";
//		die;

		$_SESSION['order_id'] = $order['order_id'];
		$data = [
			'orders' => $order
		];


//		echo "<pre>";
//		print_r($_SESSION['order_id']);
//		echo "</pre>";


		return $this->renderAdmin($this->folder . __FUNCTION__, $data);
	}

	public function update($id)
	{
		$order = $this->order->getOne($id);
		$idOld = $_SESSION['order_id'];


		echo "<pre>";
		print_r($idOld);
		echo "</pre>";

		$validation = $this->validator->make($_POST, [
			'status' => 'required'
		]);

		$validation->validate();
		if ($validation->fails()) {
			$err = $validation->errors()->firstOfAll();

			echo "<pre>";
			print_r($err);
			echo "</pre>";
		} else {
			$data = [
				'status' => $_POST['status'] ?? $order['od_id'],
			];
			
			echo "<pre>";
			print_r($data);
			echo "</pre>";
			
			

//			echo "<pre>";
//			print_r($data);
//			echo "</pre>";

//			echo "<pre>";
//			print_r($data);
//			echo "</pre>";
//
//			echo $idOld;
//			echo "</br>";
//			echo $id;

//			$this->order->update($id, $data);
			$this->order->update($idOld, $data);
			setToastr('Update order success', 'success');
			header('location: ' . routeAdmin("orders/{$id}/edit"));

//			echo "<pre>";
//			print_r($data);
//			echo "</pre>";
		}
	}

	public function delete($id)
	{

	}
}