<?php

namespace app\models\product;

use app\Database;
use app\helpers\UtilHelper;

abstract class Product
{
    protected string $SKU;
    protected string $name;
    protected float $price;

    public static function getTypes()
    {
        return ['book', 'dvd', 'furniture'];
    }
    abstract function load($data);

    protected function save()
    {
        return Database::$db;
    }
}
