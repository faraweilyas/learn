<?php

use App\Core\App;
use App\Middleware\FirstMiddleware;
use App\Middleware\SecondMiddleware;

require_once __DIR__ . '/vendor/autoload.php';

$app = new App();

$app->add(new FirstMiddleware());
$app->add(new SecondMiddleware());

$app->run();

// https://www.lynda.com/PHP-tutorials/Welcome/382572/415817-4.html
