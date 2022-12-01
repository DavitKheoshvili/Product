<?php

namespace app\models\product;
use PDO;
use app\models\product\interfaces\ProductInterface;
use app\helpers\UtilHelper;

class Dvd extends Product implements ProductInterface
{
    private int $size;
    
    public function load($data) {
        $this->SKU = UtilHelper::randomString(10);
        $this->name = $data['name'];
        $this->price = $data['price'];
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

        $statement = $pdo->prepare("INSERT INTO dvd (SKU, size)
                VALUES (:SKU, :size)");
        $statement->bindValue(':SKU', $this->SKU);
        $statement->bindValue(':size', $this->size);

        return $statement;
    }
}