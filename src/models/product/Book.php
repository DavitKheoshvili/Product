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
        $this->price = $data['price'];
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
        parent::save();
    }
    public function getStatementAndBindValues(PDO $pdo)
    {
        $statement = $pdo->prepare("INSERT INTO products (SKU, name, price)
        VALUES (:SKU, :name, :price)");
        $statement->bindValue(':SKU', $this->SKU);
        $statement->bindValue(':name', $this->name);
        $statement->bindValue(':price', $this->price);

        $statement->execute();

        $statement = $pdo->prepare("INSERT INTO book (SKU, weight)
                VALUES (:SKU, :weight)");
        $statement->bindValue(':SKU', $this->SKU);
        $statement->bindValue(':weight', $this->weight);

        return $statement;
    }
}