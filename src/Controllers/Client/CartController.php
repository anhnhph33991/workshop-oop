<?php

namespace LuxChill\Controllers\Client;

use LuxChill\Commons\Controller;
use LuxChill\Models\Cart;
use LuxChill\Models\CartDetail;
use LuxChill\Models\Product;

class CartController extends Controller
{
	private Cart $cart;
	private CartDetail $cartDetail;
	private Product $product;

	public function __construct()
	{
		$this->cart = new Cart();
		$this->cartDetail = new CartDetail();
		$this->product = new Product();
	}

	public function index()
	{
		if (isset($_SESSION['user'])) {
			$dataCart = $this->cart->findByUserId($_SESSION['user']['id']);
//			$carts = $this->cartDetail->selectInnerJoinProduct($dataCart['id']);

			if (!empty($dataCart)) {
				$carts = $this->cartDetail->selectInnerJoinProduct($dataCart['id']);
			} else {
				$carts = [];
			}
		} else {
			if (isset($_SESSION['cart'])) {
				$carts = $_SESSION['cart'];
			} else {
				$carts = [];
			}
		}

//		echo "<pre>";
//		print_r($carts);
//		echo "</pre>";

		$data = [
			'carts' => $carts
		];
		return $this->renderClient('cart', $data);
	}

	public function add()
	{
		$qtyUpdate = 0;
		$countCart = 0;

		if ($_POST) {

			$product_id = $_POST['productId'];
			$product_qty = $_POST['quantity'];
			$user_id = $_SESSION['user']['id'] ?? 0;

			if ($user_id == 0) {
				if (!isset($_SESSION['cart'])) {
					$_SESSION['cart'] = [];
					$message = "create session cart success";
				}

				$products = $this->product->getOne($product_id);

				$dataProduct = [
					'c_id' => 1,
					'cart_id' => 2,
					'p_id' => $product_id,
					'quantity' => $product_qty,
					'name' => $products['p_name'],
					'slug' => $products['p_slug'],
					'image' => $products['p_image'],
					'category_id' => $products['c_id'],
					'price' => $products['price'],
					'price_offer' => $products['price_offer'],
					'p_quantity' => $products['quantity'],
					'sku' => $products['sku'],
					'status' => $products['status'],
					'type' => $products['type'],
				];

				if (!isset($_SESSION['cart'][$products['p_id']])) {
					$_SESSION['cart'][$product_id] = $dataProduct;
					$countCart = count($_SESSION['cart']);
					$message = "Add product to session cart";
				} else {
					$_SESSION['cart'][$product_id]['quantity'] += $product_qty;
					$countCart = count($_SESSION['cart']);
					$message = "Update qty product";
				}

//				$message = 'Create session cart no user';

			} else {
				$connect = $this->cart->getConnect();
//				$connect->beginTransaction();

				try {
					// get one cart
					$checkCart = $this->cart->findByUserId($user_id);
					// get one product
//					$product = $this->product->getOne($product_id);

					// neu cart rong thi moi insert
					if (empty($checkCart)) {
						$this->cart->insert([
							'user_id' => $user_id
						]);
					}

					$cartId = $checkCart['id'] ?? $connect->lastInsertId();
					$checkProductCartDetail = $this->cartDetail->findByCartIdAndProductId($cartId, $product_id);

					if (empty($checkProductCartDetail)) {
						$this->cartDetail->insert([
							'cart_id' => $cartId,
							'product_id' => $product_id,
							'quantity' => $product_qty
						]);
					} else {
						$qtyUpdate = $checkProductCartDetail['quantity'] + $product_qty;
						$this->cartDetail->updateByCartIDAndProductID($cartId, $product_id, $qtyUpdate);
					}

					$countCart = $this->cartDetail->getCount($cartId);

					$message = 'Insert data carts';
//					$connect->commit();
				} catch (\Throwable $e) {
//					$connect->rollBack();
					$message = "LuxChill: " . $e->getMessage();
				}
			}

			header('Content-Type: application/json');
			echo json_encode([
				'productId' => $product_id,
				'quantity' => $product_qty,
//				'cartID' => $cartId,
				'message' => $message,
				'qtyUpdate' => $qtyUpdate,
				'count' => $countCart
			]);
		}
	}

	public function delete($id)
	{
//		echo $id;

		if (isset($_SESSION['user'])) {
			$this->cartDetail->delete($id);
			setToastr('Delete success', 'success');
			header('location: ' . routeClient('cart'));
		} else {
			unset($_SESSION['cart'][$id]);
			setToastr('Delete product success', 'success');
			header('location: ' . routeClient('cart'));
		}
	}

	public function update()
	{
		if ($_POST) {
			$id = $_POST['id'];
			$quantity = $_POST['quantity'];
			$price = $_POST['price'];
			$cartId = $_POST['cartId'];
			$productId = $_POST['productId'];
			$cartIdReal = $_POST['cartIdReal'];
			$subTotal = 0;
			$priceTotal = 0;

			if (!empty($_SESSION['user'])) {
				$this->cartDetail->updateQty($id, $productId, $quantity);
				$abc = $this->cartDetail->selectInnerJoinProduct($cartIdReal);
				$subTotal = $price * $quantity;
				$priceTotal = array_reduce($abc, function ($total, $items) {
					return $total + (($items['price_offer'] ?: $items['price']) * $items['quantity']);
				}, 0);
			} else {
				$_SESSION['cart'][$id]['quantity'] = $quantity;
				$subTotal = $price * $quantity;
				$priceTotal = reduce_price($_SESSION['cart']);
			}

			header('Content-Type: application/json');
			echo json_encode([
				'quantity' => $quantity,
				'subTotal' => $subTotal,
				'priceTotal' => $priceTotal,
				'cartId' => $cartId,
				'productId' => $productId
			]);
		}
	}

}