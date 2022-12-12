<?php

namespace app\models\product;
use PDO;
use app\models\product\interfaces\ProductInterface;
use app\helpers\UtilHelper;

class Book extends Product implements ProductInterface
{
    private int $weight;
    
    public function load($data) {
        $this->SKU = UtilHelper::randomString(10);
        $this->name = $data['name'];
        $this->price = (float)$data['price'];
        $this->type = $data['type'];
        $this->weight = (int)$data['weight'];
    }

    public function getData() 
    {
        $data['sku'] = $this->SKU;
        $data['name'] = $this->name;
        $data['price'] = $this->price;
        $data['weight'] = $this->weight;

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

        $statement = $pdo->prepare("INSERT INTO book (SKU, weight)
                VALUES (:SKU, :weight)");
        $statement->bindValue(':SKU', $this->SKU);
        $statement->bindValue(':weight', $this->weight);

        return $statement;
    }
}