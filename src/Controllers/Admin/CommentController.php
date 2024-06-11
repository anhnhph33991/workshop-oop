<?php

namespace LuxChill\Controllers\Admin;

use LuxChill\Commons\Controller;
use LuxChill\Interfaces\InterfaceCrudController;
use LuxChill\Models\Comment;
use LuxChill\Models\Product;
use LuxChill\Models\User;

class CommentController extends Controller implements InterfaceCrudController
{
	private string $folder = 'comments.';

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

		$page = $_GET['page'] ?? 1;
		[$comments, $totalPage] = $this->comment->paginate($page, 1);

		$data = [
			'comments' => $comments,
			'totalPage' => $totalPage,
			'page' => $page
		];

		return $this->renderAdmin($this->folder . __FUNCTION__, $data);
	}

	public function create(){
		$data = [
			'products' => $this->product->getAll('*'),
			'users' => $this->user->getAll('*')
		];
		return $this->renderAdmin($this->folder . __FUNCTION__, $data);
	}

	public function store(){

		$validation = $this->validator->make($_POST, [
			'content' => "required|max:255"
		]);

		$validation->validate();

		if($validation->fails()){
			$_SESSION['errors'] = $validation->errors()->firstOfAll();
			header('location: ' . routeAdmin('comments/create'));
		}else{
			$data = [
				'content' => $_POST['content'],
				'product_id' => $_POST['product_id'],
				'user_id' => $_POST['user_id']
			];

			$this->comment->insert($data);
			setToastr('Create comment success', 'success');
			header('location: ' . routeAdmin('comments'));
		}
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
		if($id){
			$this->comment->delete($id);
			setToastr('Delete comment success', 'success');
			header('location: ' . routeAdmin('comments'));
		}
	}
}