<?php
use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
require __DIR__ . '/../vendor/autoload.php';
Dotenv::createImmutable(__DIR__ . '/..')->safeLoad();
$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);
$app->add(new App\Middleware\SecurityHeaders());
$app->add(new App\Middleware\JsonBodyParser());
$app->add(new App\Middleware\Cors()); // outermost — CORS headers on all responses, including errors
(require __DIR__ . '/../src/routes.php')($app);
$app->run();