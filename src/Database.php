<?php
/**
 * Database class. Connects to database, handles Selects, inserts and deletes 
 */
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
        foreach ($types as $type) {
            $statement = $this->pdo->prepare(
                'SELECT * FROM products INNER JOIN ' . $type . ' ON products.SKU = ' . $type . '.SKU'
            );
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

    public function deleteProduct($SKU, $type)
    {
        $mainStatement = $this->pdo->prepare('DELETE FROM products WHERE SKU = :SKU');
        $mainStatement->bindValue(':SKU', $SKU);

        $productStatement = $this->pdo->prepare('DELETE FROM ' . $type . ' WHERE SKU = :SKU');
        $productStatement->bindValue(':SKU', $SKU);

        return ($mainStatement->execute() && $productStatement->execute());
    }

    public function massDeleteProduct($products)
    {
        foreach ($products as $index => $product) {
            $this->deleteProduct($product->sku, $product->type);
        }
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
