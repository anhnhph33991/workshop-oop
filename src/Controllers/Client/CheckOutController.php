<?php

namespace LuxChill\Controllers\Client;

use LuxChill\Commons\Controller;
use LuxChill\Models\Cart;
use LuxChill\Models\CartDetail;
use LuxChill\Models\Order;
use LuxChill\Models\OrderDetail;
use LuxChill\Models\Product;
use LuxChill\Models\User;
use Rakit\Validation\Rules\UniqueEmailRule;

class CheckOutController extends Controller
{

	private Cart $cart;
	private CartDetail $cartDetail;
	private Product $product;
	private User $user;
	private Order $order;
	private OrderDetail $orderDetail;

	public function __construct()
	{
		parent::__construct();
		$this->cart = new Cart();
		$this->cartDetail = new CartDetail();
		$this->product = new Product();
		$this->user = new User();
		$this->order = new Order();
		$this->orderDetail = new OrderDetail();
	}

	public function index()
	{
		if (!empty($_SESSION['user'])) {
			$cart = $this->cart->findByUserId($_SESSION['user']['id']);
			$cartDetail = $this->cartDetail->selectInnerJoinProduct($cart['id']);
		} else {
			$cartDetail = $_SESSION['cart'];
		}

//		echo "<pre>";
//		print_r($cartDetail);
//		echo "</pre>";

		$data = [
			'dataCart' => $cartDetail
		];

		return $this->renderClient('checkout', $data);
	}

	public function add()
	{
//		echo "<pre>";
//		print_r($_POST);
//		echo "</pre>";

		$userId = $_SESSION['user']['id'] ?? null;

		if (isset($_SESSION['user'])) {
			$dataCart = $this->cart->findByUserId($_SESSION['user']['id']);
			$dataInsert = $this->cartDetail->selectInnerJoinProduct($dataCart['id']);
		} else {
			if (isset($_SESSION['cart'])) {
				$dataInsert = $_SESSION['cart'];
			} else {
				$dataInsert = [];
			}
		}

		$this->validator->addValidator('uniqueEmail', new UniqueEmailRule());
		$validation = $this->validator->make($_POST + $_FILES, [
			'username' => "required|max:255",
			'email' => "required|max:255|email",
			'phone' => "required|digits:10",
			'address_shipping' => "required"
		]);

		$validation->validate();

		if ($validation->fails()) {
			$_SESSION['errors'] = $validation->errors()->firstOfAll();
			header('location: ' . routeClient('check-out'));
			exit();
		} else {
			if ($_POST['payment'] == 0) {

				if (!$userId) {
					$connect = $this->user->getConnect();
					$checkEmail = $this->user->emailExists($_POST['email']);
					if ($checkEmail) {
						$_SESSION['errors']['email'] = "Email trung voi db khach hang";
						header('location: ' . routeClient('check-out'));
						exit;
					}

					$this->user->insert([
						'username' => $_POST['username'],
						'email' => $_POST['email'],
						'phone' => $_POST['phone'],
						'is_active' => 0
					]);
					$userId = $connect->lastInsertId();
				}

				// add data order
				$connect = $this->order->getConnect();
//				$checkOrder = $this->order->
				$this->order->insert([
					'user_id' => $userId,
					'user_name' => $_POST['username'],
					'user_email' => $_POST['email'],
					'user_phone' => $_POST['phone'],
					'address_shipping' => $_POST['address_shipping'],
					'payment_method' => $_POST['payment'],
					'payment_status' => 0
				]);

				$orderId = $connect->lastInsertId();

				foreach ($dataInsert as $data) {
					$this->orderDetail->insert([
						'order_id' => $orderId,
						'product_id' => $data['p_id'],
						'product_name' => $data['name'],
						'price' => $data['price'],
						'price_offer' => $data['price_offer'],
						'qty' => $data['quantity']
					]);
				}

				if (isset($_SESSION['user'])) {
					$cartSelect = $this->cart->findByUserId($_SESSION['user']['id']);
					$this->cartDetail->deleteByCartID($cartSelect['id']);
//					$this->cart->deleteByUserId($_SESSION['user']['id']);
				} else {
					unset($_SESSION['cart']);
				}

				setToastr('Order success', 'success');
				header('location: ' . routeClient('cart'));


//				$data = [
//					'username' => $_POST['username'],
//					'email' => $_POST['email'],
//					'phone' => $_POST['phone'],
//					'address_shipping' => $_POST['address_shipping']
//				];

//			echo "<pre>";
//			print_r($data);
//			echo "</pre>";

			} else {

				$_SESSION['infoOrder'] = [
					'username' => $_POST['username'],
					'email' => $_POST['email'],
					'phone' => $_POST['phone'],
					'address_shipping' => $_POST['address_shipping'],
					'payment' => $_POST['payment']
				];

				if (isset($_POST['payUrl'])) {
					momo($_POST['priceTotal']);
				}
			}
		}

	}

	public function handleMomo()
	{
		if (isset($_GET['resultCode']) && $_GET['resultCode'] == 0) {
			$userId = $_SESSION['user']['id'] ?? null;

			if (isset($_SESSION['user'])) {
				$dataCart = $this->cart->findByUserId($_SESSION['user']['id']);
				$dataInsert = $this->cartDetail->selectInnerJoinProduct($dataCart['id']);
			} else {
				if (isset($_SESSION['cart'])) {
					$dataInsert = $_SESSION['cart'];
				} else {
					$dataInsert = [];
				}
			}

			if (!$userId) {
				$connect = $this->user->getConnect();
				$checkEmail = $this->user->emailExists($_SESSION['infoOrder']['email']);
				if ($checkEmail) {
					$_SESSION['errors']['email'] = "Email trung voi db khach hang";
					header('location: ' . routeClient('check-out'));
					exit;
				}

				$this->user->insert([
					'username' => $_SESSION['infoOrder']['username'],
					'email' => $_SESSION['infoOrder']['email'],
					'phone' => $_SESSION['infoOrder']['phone'],
					'is_active' => 0
				]);
				$userId = $connect->lastInsertId();
			}

			// add data order
			$connect = $this->order->getConnect();
//				$checkOrder = $this->order->
			$this->order->insert([
				'user_id' => $userId,
				'user_name' => $_SESSION['infoOrder']['username'],
				'user_email' => $_SESSION['infoOrder']['email'],
				'user_phone' => $_SESSION['infoOrder']['phone'],
				'address_shipping' => $_SESSION['infoOrder']['address_shipping'],
				'payment_method' => $_SESSION['infoOrder']['payment'],
				'payment_status' => 1
			]);

			$orderId = $connect->lastInsertId();

			foreach ($dataInsert as $data) {
				$this->orderDetail->insert([
					'order_id' => $orderId,
					'product_id' => $data['p_id'],
					'product_name' => $data['name'],
					'price' => $data['price'],
					'price_offer' => $data['price_offer'],
					'qty' => $data['quantity']
				]);
			}

			if (isset($_SESSION['user'])) {
				$cartSelect = $this->cart->findByUserId($_SESSION['user']['id']);
				$this->cartDetail->deleteByCartID($cartSelect['id']);
//					$this->cart->deleteByUserId($_SESSION['user']['id']);
			} else {
				unset($_SESSION['cart']);
			}

			unset($_SESSION['infoOrder']);
			setToastr('Order success', 'success');
			header('location: ' . routeClient('cart'));
		}
	}


	public function confirm()
	{
		return $this->renderClient('confirm');
	}

	public function validateFormOne($username, $email, $phone, $address)
	{
		$validation = $this->validator->make($_POST + $_FILES, [
			'username' => "required|max:255",
			'email' => "required|max:255|email|uniqueEmail",
			'phone' => "required|digits:10",
			'address_shipping' => "required"
		]);

		$validation->validate();

		if ($validation->fails()) {
			$errors = $validation->errors()->firstOfAll();

			echo "<pre>";
			print_r($errors);
			echo "</pre>";
		} else {
			echo "success";
		}
	}
}