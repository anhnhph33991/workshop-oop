<?php

namespace LuxChill\Controllers\Admin;

use LuxChill\Commons\Controller;
use LuxChill\Interfaces\InterfaceCrudController;
use LuxChill\Models\Comment;
use LuxChill\Models\Product;
use LuxChill\Models\User;

class CartController extends Controller implements InterfaceCrudController
{

	private string $folder = 'carts.';
	private  Comment $comment;
	private  User $user;
	private  Product $product;

	public function __construct()
	{
		parent::__construct();
		$this->user = new User();
		$this->product = new Product();
		$this->comment = new Comment();
	}

	public function index(){
		return $this->renderAdmin($this->folder . __FUNCTION__);
	}

	public function create(){
		$data = [
			'products' => $this->product->getAll('*'),
			'users' => $this->user->getAll('*')
		];
		return $this->renderAdmin($this->folder . __FUNCTION__, $data);
	}

	public function store(){

	}

	public function show($id){
		return $this->renderAdmin($this->folder . __FUNCTION__);
	}

	public function edit($id){
		return $this->renderAdmin($this->folder . __FUNCTION__);
	}

	public function update($id){

	}

	public function delete($id){

	}
}