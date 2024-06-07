<?php

namespace LuxChill\Commons;

use eftec\bladeone\BladeOne;
use Rakit\Validation\Validator;

class Controller
{
	protected $validator;

	public function __construct()
	{
		$this->validator = new Validator;
		$this->setMessagesValidate();
	}
	public function renderView(string $view, array $data, string $type)
	{
		$tempPath = __DIR__ . "/../Views/{$type}";
		$compiles = __DIR__ . "/../Views/Compiles";
		$blade = new BladeOne($tempPath, $compiles);
		echo $blade->run($view, $data);
	}

	public function renderAdmin(string $view, array $data = [])
	{
		$this->renderView($view, $data, 'Admin');
	}

	public function renderClient(string $view, array $data = [])
	{
		$this->renderView($view, $data, 'Client');
	}

	public function setMessagesValidate()
	{
		$this->validator->setMessages([
			'email:email' => 'Email không đúng định dạng 🤬',
			'digits' => 'Phải là số và 10 kí tự 🤬',
			// set riêng các trường
			'username:required' => 'Vui lòng nhập username 🤬',
			'email:required' => 'Vui lòng nhập email 🤬',
			'password:required' => 'Vui lòng nhập password 🤬',
			'phone:required' => 'Vui lòng nhập phone 🤬',
			'image:required' => 'Vui lòng tải image 🤬',
			'password:min' => 'Password tối thiểu 5 kí tự',
			'image:uploaded_file' => 'File gì lớn thế - Tối đa 500K',
			'password:alpha_num' => 'Password chỉ nhận số và chữ thường🤬',
			'address:required' => 'Vui long nhap address 🤬',
			// posts
			'title:required' => 'Vui lòng nhập title 🤬',
			'content:required' => 'Vui lòng nhập content 🤬',
			// 'phone:digits' => 'Phone Phải là số và 10 kí tự 🤬'
			// categories
			'name:required' => 'Vui long nhap name category 🤬',
		]);
	}
}
