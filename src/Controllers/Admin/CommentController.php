<?php

namespace LuxChill\Controllers\Admin;

use LuxChill\Commons\Controller;
use LuxChill\Interfaces\InterfaceCrudController;

class CommentController extends Controller implements InterfaceCrudController
{
	private string $folder = 'comments.';
	public function index(){
		return $this->renderAdmin($this->folder . __FUNCTION__);
	}

	public function create(){
		return $this->renderAdmin($this->folder . __FUNCTION__);
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