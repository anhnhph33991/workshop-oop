<?php

namespace LuxChill\Controllers\Client;

use LuxChill\Commons\Controller;

class Orders extends Controller
{
	public function check()
	{
		return $this->renderClient('trackorder');
	}
}