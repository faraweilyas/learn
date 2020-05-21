<?php

use App\Core\App;
use App\Middleware\FirstMiddleware;
use App\Middleware\ThirdMiddleware;
use App\Middleware\SecondMiddleware;

require_once __DIR__ . '/vendor/autoload.php';

$app = new App();

$app->add(new FirstMiddleware());
$app->add(new SecondMiddleware());
$app->add(new ThirdMiddleware());

$app->run();
