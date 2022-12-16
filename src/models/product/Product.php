<?php

namespace app\models\product;

use app\Database;

abstract class Product
{
    protected string $SKU;
    protected string $name;
    protected float $price;
    protected string $type;

    public static function getTypes()
    {
        return ['book', 'dvd', 'furniture'];
    }
    abstract function load($data);

    private function validateSKU($sku)
    {
        return preg_match("/^[A-Za-z0-9]{8,10}$/", $sku);
    }
    private function validateName($name)
    {
        return preg_match("/^[\w\s]{3,50}$/", $name);
    }
    private function validatePrice($price)
    {
        return preg_match("/^[0-9]{1,10}\.?[0-9]{0,2}$/", $price);
    }
    protected function validate($data)
    {
        return 
        self::validateSKU($data["sku"]) && 
        self::validateName($data["name"]) && 
        self::validatePrice($data["price"]);
    }
    protected function save()
    {
        return Database::$db;
    }
}
