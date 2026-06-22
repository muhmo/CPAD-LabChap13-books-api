<?php
use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
require __DIR__ . '/../vendor/autoload.php';
Dotenv::createImmutable(__DIR__ . '/..')->safeLoad();
$app = AppFactory::create();
$app->add(new App\Middleware\SecurityHeaders()); // ← added FIRST so it runs LAST
$app->add(new App\Middleware\JsonBodyParser());
$app->add(new App\Middleware\Cors());
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);
(require __DIR__ . '/../src/routes.php')($app);
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
$app->run();