<?php

namespace app\controllers;

use app\Router;
use ReflectionClass;

class ProductController
{
    public static function index(Router $router)
    {
        $products = $router->database->getProducts();
        $router->renderView('products/index', [
            'products' => $products,
        ]);
    }

    public static function create(Router $router)
    {
        $productData = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
         {
            foreach($_POST as $key => $value)
            {
                $productData[$key] = $value;
            }
            
            $product = (new ReflectionClass("app\models\product\\" . ucfirst($_POST['type'])))->newInstance();
            $product->load($productData);
            $product->save();
            header('Location: /products');
            exit;
        }
        $router->renderView('products/create', [
            'product' => $productData
        ]);
    }

    // public static function update(Router $router)
    // {
    //     $id = $_GET['id'] ?? null;
    //     if (!$id) {
    //         header('Location: /products');
    //         exit;
    //     }
    //     $productData = $router->database->getProductById($id);

    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $productData['title'] = $_POST['title'];
    //         $productData['description'] = $_POST['description'];
    //         $productData['price'] = $_POST['price'];
    //         $productData['imageFile'] = $_FILES['image'] ?? null;

    //         $product = new Product();
    //         $product->load($productData);
    //         $product->save();
    //         header('Location: /products');
    //         exit;
    //     }

    //     $router->renderView('products/update', [
    //         'product' => $productData
    //     ]);
    // }

    public static function massDelete(Router $router)
    {
        $products = ['takhti200' => 'furniture', '6WXXUWGWFD' => 'furniture'];
        $router->database->massDeleteProduct($products);

        header('Location: /');
        exit;
    }
}