<?php

/** @var TYPE_NAME $router */

use LuxChill\Controllers\Client\HomeController;

$router->get('/', HomeController::class . '@index');
