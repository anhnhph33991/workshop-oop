<?php

namespace LuxChill\Interfaces;

interface InterfaceCrudModel
{
	public function getAll();

	public function getOne($id);

	public function paginate($page, $perPage);

	public function insert(array $data);

	public function update($id, $data);

	public function delete($id);

}