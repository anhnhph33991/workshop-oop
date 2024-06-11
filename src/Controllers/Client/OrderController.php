<?php

namespace LuxChill\Controllers\Client;

use LuxChill\Commons\Controller;
use LuxChill\Models\Order;
use LuxChill\Models\OrderDetail;

class OrderController extends Controller
{
	private Order $order;
	private OrderDetail $orderDetail;

	public function __construct()
	{
		$this->order = new Order();
		$this->orderDetail = new OrderDetail();
	}

	public function check()
	{
		return $this->renderClient('trackorder');
	}

	public function myOrder()
	{
		$productOrderDetail = [];
		$userId = $_SESSION['user']['id'] ?? null;
		$selectAllOrder = $this->order->getAllByUserId($userId);

		foreach ($selectAllOrder as $order) {
			$selectAllOrderDetail = $this->orderDetail->getAllOrderDetailByProductId($order['id']);
			foreach ($selectAllOrderDetail as $orderDetail) {
				$dataInerJoin = $this->orderDetail->getAllOrderDetail($orderDetail['order_id'], $orderDetail['product_id']);
				$productOrderDetail[] = $dataInerJoin;
			}
		}

		$data = [
			'productOrder' => $productOrderDetail
		];

		return $this->renderClient('myOrder', $data);
	}

	public function detail($id)
	{
		$getOne = $this->orderDetail->getOne($id);
		$dataJoin = $this->orderDetail->getOneOrderDetail($getOne['id'], $getOne['product_id']);

		$data = [
			'order' => $dataJoin
		];

		return $this->renderClient('orderDetail', $data);
	}

	public function delete($id)
	{
		$this->orderDetail->delete($id);
		setToastr('Huy Don Thanh Cong', 'success');
		header('location: ' . routeClient(''));
	}
}