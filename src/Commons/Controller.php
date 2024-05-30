<?php
namespace LuxChill\Commons;
use eftec\bladeone\BladeOne;

class Controller
{
	public function renderView(string $view, array $data, string $type)
	{
		$tempPath = __DIR__ . "/../Views/{$type}";
		$compiles = __DIR__ . "/../Views/compiles";
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

	public function handlePagination($page, $limit)
	{
		$limit = $limit ?? 10; // set default limit = 10
		$initial_page = ($page - 1) * $limit;

		return [
			'limit' => $limit,
			'initial_page' => $initial_page
		];
	}
}