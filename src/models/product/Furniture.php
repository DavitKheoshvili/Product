<?php

namespace app\models\product;

use PDO;
use app\models\product\interfaces\ProductInterface;

class Furniture extends Product implements ProductInterface
{
    private int $width;
    private int $height;
    private int $length;

    protected function validate($data)
    {
        return
            $this->validateHeight($data['height']) &&
            $this->validateWidth($data['width']) &&
            $this->validateLength($data['length']);
    }

    private function validateHeight($height)
    {
        return preg_match("/^[1-9][0-9]*?$/", $height);
    }

    private function validateWidth($width)
    {
        return preg_match("/^[1-9][0-9]*?$/", $width);
    }

    private function validateLength($length)
    {
        return preg_match("/^[1-9][0-9]*?$/", $length);
    }

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
