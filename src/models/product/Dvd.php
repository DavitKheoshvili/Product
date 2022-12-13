<?php

namespace app\models\product;
use PDO;
use app\models\product\interfaces\ProductInterface;
use app\helpers\UtilHelper;

class Dvd extends Product implements ProductInterface
{
    private int $size;
    
    public function load($data) {
        $this->SKU = $data['sku'];
        $this->name = $data['name'];
        $this->price = (float)$data['price'];
        $this->type = $data['type'];
        $this->size = (int)$data['size'];
    }

    public function getData() 
    {
        $data['sku'] = $this->SKU;
        $data['name'] = $this->name;
        $data['price'] = $this->price;
        $data['size'] = $this->size;

        return $data;
    }
    public function save()
    {
        $db = parent::save();
        $db->createProducts($this);
    }
    public function getStatementAndBindValues(PDO $pdo)
    {
        $statement = $pdo->prepare("INSERT INTO products (SKU, name, price, type)
        VALUES (:SKU, :name, :price, :type)");
        $statement->bindValue(':SKU', $this->SKU);
        $statement->bindValue(':name', $this->name);
        $statement->bindValue(':price', $this->price);
        $statement->bindValue(':type', $this->type);

        $statement->execute();

        $statement = $pdo->prepare("INSERT INTO dvd (SKU, size)
                VALUES (:SKU, :size)");
        $statement->bindValue(':SKU', $this->SKU);
        $statement->bindValue(':size', $this->size);

        return $statement;
    }
}