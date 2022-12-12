<?php

namespace app\controllers;

use app\Router;
use ReflectionClass;

class ProductController
{
    public static function index(Router $router)
    {
        $products = $router->database->getProducts();

        header('Content-type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');

        // echo json_encode((object) $products);
        echo json_encode($products);
    }

    public static function create(Router $router)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        $productData = (array) json_decode(file_get_contents('php://input'));
    
        $product = (new ReflectionClass("app\models\product\\" . ucfirst($productData['type'])))->newInstance();
        $product->load($productData);
        $product->save();
    }

    public static function massDelete(Router $router)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        //$productData = (array) json_decode(file_get_contents('php://input'));
        $products = json_decode(file_get_contents('php://input'));
        // exit;
        // $products = ['takhti200' => 'furniture', '6WXXUWGWFD' => 'furniture'];
        $router->database->massDeleteProduct($products);

        header('Location: /');
        exit;
    }
}
