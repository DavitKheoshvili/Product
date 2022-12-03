<?php

namespace app\models\product;
use PDO;
use app\models\product\interfaces\ProductInterface;
use app\helpers\UtilHelper;


class Furniture extends Product implements ProductInterface
{
    private int $width;
    private int $height;
    private int $length;

    public function load($data) {
        $this->SKU = UtilHelper::randomString(10);
        $this->name = $data['name'];
        $this->price = $data['price'];
        $this->width = (int)$data['width'];
        $this->height = (int)$data['height'];
        $this->length = (int)$data['length'];
    }

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
    public function save()
    {
        $db = parent::save();
        $db->createProducts($this);
    }
    public function getStatementAndBindValues(PDO $pdo)
    {
        $statement = $pdo->prepare("INSERT INTO products (SKU, name, price)
        VALUES (:SKU, :name, :price)");
        $statement->bindValue(':SKU', $this->SKU);
        $statement->bindValue(':name', $this->name);
        $statement->bindValue(':price', $this->price);

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