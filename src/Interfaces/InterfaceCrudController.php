<?php

namespace LuxChill\Interfaces;

interface InterfaceCrudController
{
	public function index();

	public function create();

	public function store();

	public function show($id);

	public function edit($id);

	public function update($id);

	public function delete($id);
}