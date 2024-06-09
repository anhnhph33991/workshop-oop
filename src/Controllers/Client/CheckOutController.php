<?php

namespace LuxChill\Controllers\Client;

use LuxChill\Commons\Controller;

class CheckOutController extends Controller
{
	public function index()
	{
		return $this->renderClient('checkout');
	}

	public function confirm()
	{
		return $this->renderClient('confirm');
	}
}