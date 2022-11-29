<?php

namespace app;

use app\models\product\Product;
use app\models\product\interfaces\ProductInterface;
use PDO;

class Database
{
    public $pdo = null;
    public static ?Database $db = null;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=mysql;port=3306;dbname=products', 'root', 'root');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$db = $this;
    }

    public function getProducts()
    {
        $types = Product::getTypes();
        $products = [];
        foreach($types as $type){
            $statement = $this->pdo->prepare(
                'SELECT * FROM products INNER JOIN ' . $type . ' ON products.SKU = ' . $type . '.SKU');
            $statement->execute();
            $products = array_merge($products, $statement->fetchAll(PDO::FETCH_ASSOC));
        }
    
        return $products;
    }

    public function getProductById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM product WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteProduct($id)
    {
        $statement = $this->pdo->prepare('DELETE FROM product WHERE id = :id');
        $statement->bindValue(':id', $id);

        return $statement->execute();
    }

    public function createProduct(Product $product)
    {
        $statement = $this->pdo->prepare("INSERT INTO product (title, imagePath, description, price, create_date)
                VALUES (:title, :imagePath, :description, :price, :date)");
        $statement->bindValue(':title', $product->title);
        $statement->bindValue(':imagePath', $product->imagePath);
        $statement->bindValue(':description', $product->description);
        $statement->bindValue(':price', $product->price);
        $statement->bindValue(':date', date('Y-m-d H:i:s'));

        $statement->execute();
    }

    public function createProducts(ProductInterface $product)
    {
        $statement = $product->getStatementAndBindValues($this->pdo);

        $statement->execute();
    }
}