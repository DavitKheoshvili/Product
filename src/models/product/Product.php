<?php

namespace app\models\product;
use app\Database;
use app\helpers\UtilHelper;

abstract class Product
{
    protected string $SKU;
    protected string $name;
    protected float $price;

    public static function getTypes(){
        return ['book', 'dvd', 'furniture'];
    }
    abstract function load($data);

    protected function save()
    {
        $errors = [];
        // if (!is_dir(__DIR__ . '/../public/images')) {
        //     mkdir(__DIR__ . '/../public/images');
        // }

        if (!$this->name) {
            $errors[] = 'Product title is required';
        }

        if (!$this->price) {
            $errors[] = 'Product price is required';
        }

        if (empty($errors)) {
            
            $db = Database::$db;
            $db->createProducts($this);
        }
    }
}