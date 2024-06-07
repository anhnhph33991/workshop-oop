<?php

namespace LuxChill\Controllers\Admin;

use LuxChill\Commons\Controller;

class DashboardController extends Controller
{
	public function index()
	{
		return $this->renderAdmin('dashboard');
	}
}
