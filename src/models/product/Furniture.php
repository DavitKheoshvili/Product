<?php

/**
 * Furniture type class
 */

namespace app\models\product;

use PDO;
use app\models\product\interfaces\ProductInterface;

class Furniture extends Product implements ProductInterface
{
    private int $width;
    private int $height;
    private int $length;
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
            $this->validateHeight($data['height']) &&
            $this->validateWidth($data['width']) &&
            $this->validateLength($data['length']);
    }
    /**
     * Checks if string matchs the height regex
     * 
     * @param string
     * 
     * @return int 1 if match. 0 if does not match
     */
    private function validateHeight($height)
    {
        return preg_match("/^[1-9][0-9]*?$/", $height);
    }
    /**
     * Checks if string matchs the width regex
     * 
     * @param string
     * 
     * @return int 1 if match. 0 if does not match
     */
    private function validateWidth($width)
    {
        return preg_match("/^[1-9][0-9]*?$/", $width);
    }
    /**
     * Checks if string matchs the length regex
     * 
     * @param string
     * 
     * @return int 1 if match. 0 if does not match
     */
    private function validateLength($length)
    {
        return preg_match("/^[1-9][0-9]*?$/", $length);
    }
    /**
     * If data is valid, sets data to properties
     * 
     * @param array
     * 
     * @return void
     */
    public function load($data)
    {
        if (parent::validate($data) && $this->validate($data)) {
            $this->SKU = $data['sku'];
            $this->name = $data['name'];
            $this->price = $data['price'];
            $this->type = $data['type'];
            $this->width = (int)$data['width'];
            $this->height = (int)$data['height'];
            $this->length = (int)$data['length'];
            $this->save();
        }
    }
    /**
     * get product data from properties
     * 
     * @param
     * 
     * @return array
     */
    public function getData()
    {
        $data['sku'] = $this->SKU;
        $data['name'] = $this->name;
        $data['price'] = $this->price;
        $data['width'] = $this->width;
        $data['height'] = $this->height;
        $data['length'] = $this->length;

        return $data;
    }
    /**
     * Calls Database method createProduts to insert data in ddatabase.
     * 
     * @param string
     * 
     * @return void
     */
    public function save()
    {
        $db = parent::save();
        $db->createProducts($this);
    }
    /**
     * Get pdo statement
     * 
     * @param PDO
     * 
     * @return PDOStatement
     */
    public function getStatementAndBindValues(PDO $pdo)
    {
        $statement = $pdo->prepare("INSERT INTO products (SKU, name, price, type)
        VALUES (:SKU, :name, :price, :type)");
        $statement->bindValue(':SKU', $this->SKU);
        $statement->bindValue(':name', $this->name);
        $statement->bindValue(':price', $this->price);
        $statement->bindValue(':type', $this->type);

        $statement->execute();

        $statement = $pdo->prepare("INSERT INTO furniture (SKU, width, height, length)
                VALUES (:SKU, :width, :height, :length)");
        $statement->bindValue(':SKU', $this->SKU);
        $statement->bindValue(':width', $this->width);
        $statement->bindValue(':height', $this->height);
        $statement->bindValue(':length', $this->length);

        return $statement;
    }
}
