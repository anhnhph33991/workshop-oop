<?php

namespace LuxChill\Commons;

class Helper
{
	public static function debug($data)
	{
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		die;
	}
}
