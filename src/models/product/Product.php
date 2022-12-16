<?php

/**
 * Parent class for any type products
 */

namespace app\models\product;

use app\Database;

abstract class Product
{
    protected string $SKU;
    protected string $name;
    protected float $price;
    protected string $type;

    /**
     * Get existing types of products.
     * 
     * @param 
     * 
     * @return array of strings
     */
    public static function getTypes()
    {
        return ['book', 'dvd', 'furniture'];
    }
    abstract function load($data);
    /**
     * Checks if string matchs the sku regex
     * 
     * @param string
     * 
     * @return int 1 if match. 0 if does not match
     */
    private function validateSKU($sku)
    {
        return preg_match("/^[A-Za-z0-9]{8,10}$/", $sku);
    }
    /**
     * Checks if string matchs the name regex
     * 
     * @param string
     * 
     * @return int 1 if match. 0 if does not match
     */
    private function validateName($name)
    {
        return preg_match("/^[\w\s]{3,50}$/", $name);
    }
    /**
     * Checks if string matchs the price regex
     * 
     * @param string
     * 
     * @return int 1 if match. 0 if does not match
     */
    private function validatePrice($price)
    {
        return preg_match("/^[0-9]{1,10}\.?[0-9]{0,2}$/", $price);
    }
    /**
     * Checks if string validations are ok
     * 
     * @param array
     * 
     * @return bool true if ok. False if is not ok
     */
    protected function validate($data)
    {
        return
            self::validateSKU($data["sku"]) &&
            self::validateName($data["name"]) &&
            self::validatePrice($data["price"]);
    }
    /**
     * Child elements of this class can get Database object
     * 
     * @param
     * 
     * @return Database 
     */
    protected function save()
    {
        return Database::$db;
    }
}
