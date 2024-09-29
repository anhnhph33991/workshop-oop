<?php

const PATH_UPLOAD = "assets/uploads/";

if (!function_exists('dd')) {
	function dd($data)
	{
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		die;
	}
}

if (!function_exists('asset')) {
	function asset($path)
	{
		return $_ENV['ASSETS'] . $path;
	}
}

if (!function_exists('routeAdmin')) {
	function routeAdmin($uri = null)
	{
		return $_ENV['BASE_URL_ADMIN'] . $uri;
	}
}

if (!function_exists('routeClient')) {
	function routeClient($uri = null)
	{
		return $_ENV['BASE_URL'] . $uri;
	}
}

if (!function_exists('upload_file')) {
	function upload_file($file)
	{
		$imagePath = PATH_UPLOAD . time() . '-' . basename($file['name']);
		if (move_uploaded_file($file['tmp_name'], $imagePath)) {
			return $imagePath;
		}
		return null;
	}
}

if (!function_exists('upload_multifile')) {
	function upload_multifile($image)
	{
		$uploadedFiles = [];
		foreach ($image['tmp_name'] as $key => $tmp_name) {
			$fileName = $image['name'][$key];
			$fileSize = $image['size'][$key];
			$fileTmp = $image['tmp_name'][$key];
			$fileType = $image['type'][$key];

			$uploadPath = PATH_UPLOAD . time() . '-' . basename($fileName);

			if (!move_uploaded_file($fileTmp, $uploadPath)) {
				return false;
			}

			$uploadedFiles[] = $uploadPath;
		}

		return implode(",", $uploadedFiles);
	}
}


if (!function_exists('validateImage')) {
	function validateImage($image)
	{
		if (!$image['error'][0] == UPLOAD_ERR_NO_FILE) {
			return true;
		} else {
			return false;
		}
	}
}

if (!function_exists('isInvalid')) {
	function isInvalid($data)
	{
		return !empty($data) ? "is-invalid" : "";
	}
}

if (!function_exists('setToastr')) {
	function setToastr($message, $type)
	{
		$_SESSION['message'] = $message;
		$_SESSION['type'] = $type;
	}
}

if (!function_exists('unsetSessions')) {
	function unsetSessions()
	{
		unset($_SESSION['errors']);
		unset($_SESSION['message']);
		unset($_SESSION['type']);
	}
}

if (!function_exists('getDateTime')) {
	function getDateTime()
	{
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		return date('Y/m/d H:i:s');
	}
}

if (!function_exists('isEmailExists')) {
	function isEmailExists($email)
	{
		if ($email) {
			$_SESSION['errors']['email'] = 'Email already exists';
		}
	}
}

if (!function_exists('middleware_auth')) {
	function middleware_auth()
	{
		if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
			header('location: ' . routeClient());
			exit();
		}
	}
}

if (!function_exists('middleware_login')) {
	function middleware_login($password, $user)
	{
		//		$check = password_verify($password, $user['password']);

		//		echo "<pre>";
		//		var_dump($check);
		//		echo "</pre>";


		if (password_verify($password, $user['password'])) {
			$_SESSION['user'] = $user;
			if ($user['role'] == 1) {
				setToastr('Dang Nhap Thanh Cong', 'success');
				header('location: ' . routeAdmin());
				exit();
			} else {
				setToastr('Dang Nhap Thanh Cong', 'success');
				header('location: ' . routeClient());
				exit();
			}
			//			echo "success";
		} else {
			$_SESSION['errors']['password'] = 'Password k chinh xac';
			header('location: ' . routeClient('login'));
			echo "failed";
		}
	}
}

if (!function_exists('middleware_user_auth')) {
	function middleware_user_auth()
	{
		if (isset($_SESSION['user'])) {
			header('location: ' . routeClient());
			exit();
		}
	}
}

if (!function_exists('active_account')) {
	function active_account()
	{
		return !isset($_SESSION['user']) ? 'login' : 'account';
	}
}
// pre - next page

if (!function_exists('prevPage')) {
	function prevPage($uri, $page)
	{
		return $page > 1 ? routeAdmin($uri . '?page=' . ($page - 1)) : routeAdmin($uri . '?page=1');
	}
}

if (!function_exists('nextPage')) {
	function nextPage($uri, $page, $totalPage)
	{
		return routeAdmin($uri . '?page=' . ($page == $totalPage ? $page : $page + 1));
	}
}

if (!function_exists('handleSalePrice')) {
	function handleSalePrice($price)
	{
		$price = floatval($price);
		return $price * 0.8;
	}
}

if (!function_exists('formatPrice')) {
	function formatPrice($price)
	{
		return number_format($price);
	}
}

if (!function_exists('isValidateMultipleImage')) {
	function isValidateMultipleImage($files)
	{
		$check = false;
		foreach ($files['error'] as $file) {
			if ($file != UPLOAD_ERR_NO_FILE) {
				$check = true;
				break;
			}
		}
		return $check;
	}
}

if (!function_exists('formatStrlen')) {
	function formatStrlen($string, $max, $length)
	{
		return strlen($string) > $max ? substr($string, 0, $length) . '...' : $string;
	}
}

if (!function_exists('reduce_price')) {
	function reduce_price($data)
	{
		return array_reduce($data, function ($total, $items) {
			return $total + (($items['price_offer'] ?: $items['price']) * $items['quantity']);
		}, 0);
	}
}

// momo

if (!function_exists('execPostRequest')) {
	function execPostRequest($url, $data)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt(
			$ch,
			CURLOPT_HTTPHEADER,
			array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen($data)
			)
		);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		//execute post
		$result = curl_exec($ch);
		//close connection
		curl_close($ch);
		return $result;
	}
}

if (!function_exists('momo')) {
	function momo($price)
	{
		$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


		$partnerCode = 'MOMOBKUN20180529';
		$accessKey = 'klm05TvNBzhg7h7j';
		$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
		$orderInfo = "Thanh toán qua MoMo";
		$amount = $price;
		$orderId = rand(00, 9999);
		$redirectUrl = "http://localhost/workshop-oop/check-out/momo";
		$ipnUrl = "http://localhost/workshop-oop/check-out/momo";
		$extraData = "";

		$partnerCode = $partnerCode;
		$accessKey = $accessKey;
		$serectkey = $secretKey;
		$orderId = $orderId; // Mã đơn hàng
		$orderInfo = $orderInfo;
		$amount = $amount;
		$ipnUrl = $ipnUrl;
		$redirectUrl = $redirectUrl;
		$extraData = $extraData;

		$requestId = time() . "";
		$requestType = "payWithATM";
		// $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
		//before sign HMAC SHA256 signature
		$rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
		$signature = hash_hmac("sha256", $rawHash, $serectkey);
		$data = array(
			'partnerCode' => $partnerCode,
			'partnerName' => "Test",
			"storeId" => "MomoTestStore",
			'requestId' => $requestId,
			'amount' => $amount,
			'orderId' => $orderId,
			'orderInfo' => $orderInfo,
			'redirectUrl' => $redirectUrl,
			'ipnUrl' => $ipnUrl,
			'lang' => 'vi',
			'extraData' => $extraData,
			'requestType' => $requestType,
			'signature' => $signature
		);
		$result = execPostRequest($endpoint, json_encode($data));
		$jsonResult = json_decode($result, true);  // decode json

		//Just a example, please check more in there
		// setcookie("title_confirm", "Đặt hàng thành công", time() + 1);
		// setcookie("subTitle_confirm", "Đã gửi mail xác nhận đơn hàng", time() + 1);
		header('Location: ' . $jsonResult['payUrl']);
	}
}


// slug
if (!function_exists('createSlug')) {
	function createSlug($string)
	{
		//		$string = removeAccents($string);
		//		$string = preg_replace('/\s+/', '-', $string);
		//		$string = strtolower($string);
		//		return $string . '-' . time();

		$string = removeAccents($string);
		// Thay thế các ký tự không phải là chữ cái hoặc số bằng dấu gạch ngang
		$string = preg_replace('/[^a-zA-Z0-9\s]/', ' ', $string);
		// Thay thế nhiều khoảng trắng liên tiếp bằng một khoảng trắng
		$string = preg_replace('/\s+/', ' ', $string);
		// Thay thế khoảng trắng bằng dấu gạch ngang
		$string = preg_replace('/\s+/', '-', $string);
		// Chuyển tất cả các ký tự thành chữ thường
		$string = strtolower($string);
		// Thêm thời gian hiện tại vào cuối slug
		return  $string . '-' . time();
	}
}

if (!function_exists('removeAccents')) {
	function removeAccents($string)
	{
		$transliterationTable = array(
			'á' => 'a',
			'à' => 'a',
			'ả' => 'a',
			'ã' => 'a',
			'ạ' => 'a',
			'ă' => 'a',
			'ắ' => 'a',
			'ằ' => 'a',
			'ẳ' => 'a',
			'ẵ' => 'a',
			'ặ' => 'a',
			'â' => 'a',
			'ấ' => 'a',
			'ầ' => 'a',
			'ẩ' => 'a',
			'ẫ' => 'a',
			'ậ' => 'a',
			'é' => 'e',
			'è' => 'e',
			'ẻ' => 'e',
			'ẽ' => 'e',
			'ẹ' => 'e',
			'ê' => 'e',
			'ế' => 'e',
			'ề' => 'e',
			'ể' => 'e',
			'ễ' => 'e',
			'ệ' => 'e',
			'í' => 'i',
			'ì' => 'i',
			'ỉ' => 'i',
			'ĩ' => 'i',
			'ị' => 'i',
			'ó' => 'o',
			'ò' => 'o',
			'ỏ' => 'o',
			'õ' => 'o',
			'ọ' => 'o',
			'ô' => 'o',
			'ố' => 'o',
			'ồ' => 'o',
			'ổ' => 'o',
			'ỗ' => 'o',
			'ộ' => 'o',
			'ơ' => 'o',
			'ớ' => 'o',
			'ờ' => 'o',
			'ở' => 'o',
			'ỡ' => 'o',
			'ợ' => 'o',
			'ú' => 'u',
			'ù' => 'u',
			'ủ' => 'u',
			'ũ' => 'u',
			'ụ' => 'u',
			'ư' => 'u',
			'ứ' => 'u',
			'ừ' => 'u',
			'ử' => 'u',
			'ữ' => 'u',
			'ự' => 'u',
			'ý' => 'y',
			'ỳ' => 'y',
			'ỷ' => 'y',
			'ỹ' => 'y',
			'ỵ' => 'y',
			'đ' => 'd',
			'Á' => 'A',
			'À' => 'A',
			'Ả' => 'A',
			'Ã' => 'A',
			'Ạ' => 'A',
			'Ă' => 'A',
			'Ắ' => 'A',
			'Ằ' => 'A',
			'Ẳ' => 'A',
			'Ẵ' => 'A',
			'Ặ' => 'A',
			'Â' => 'A',
			'Ấ' => 'A',
			'Ầ' => 'A',
			'Ẩ' => 'A',
			'Ẫ' => 'A',
			'Ậ' => 'A',
			'É' => 'E',
			'È' => 'E',
			'Ẻ' => 'E',
			'Ẽ' => 'E',
			'Ẹ' => 'E',
			'Ê' => 'E',
			'Ế' => 'E',
			'Ề' => 'E',
			'Ể' => 'E',
			'Ễ' => 'E',
			'Ệ' => 'E',
			'Í' => 'I',
			'Ì' => 'I',
			'Ỉ' => 'I',
			'Ĩ' => 'I',
			'Ị' => 'I',
			'Ó' => 'O',
			'Ò' => 'O',
			'Ỏ' => 'O',
			'Õ' => 'O',
			'Ọ' => 'O',
			'Ô' => 'O',
			'Ố' => 'O',
			'Ồ' => 'O',
			'Ổ' => 'O',
			'Ỗ' => 'O',
			'Ộ' => 'O',
			'Ơ' => 'O',
			'Ớ' => 'O',
			'Ờ' => 'O',
			'Ở' => 'O',
			'Ỡ' => 'O',
			'Ợ' => 'O',
			'Ú' => 'U',
			'Ù' => 'U',
			'Ủ' => 'U',
			'Ũ' => 'U',
			'Ụ' => 'U',
			'Ư' => 'U',
			'Ứ' => 'U',
			'Ừ' => 'U',
			'Ử' => 'U',
			'Ữ' => 'U',
			'Ự' => 'U',
			'Ý' => 'Y',
			'Ỳ' => 'Y',
			'Ỷ' => 'Y',
			'Ỹ' => 'Y',
			'Ỵ' => 'Y',
			'Đ' => 'D',
		);

		return strtr($string, $transliterationTable);
	}
}
