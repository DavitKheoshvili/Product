<?php

use app\controllers\ProductController;
use app\Router;

require_once __DIR__.'/../vendor/autoload.php';

$database = new app\Database();
$router = new Router($database);

$router->get('/', [ProductController::class, 'index']);
$router->get('/api', [ProductController::class, 'index']);
$router->get('/products/api', [ProductController::class, 'index']);
$router->post('/products/create', [ProductController::class, 'create']);
$router->post('/products/delete', [ProductController::class, 'massDelete']);

$router->resolve();