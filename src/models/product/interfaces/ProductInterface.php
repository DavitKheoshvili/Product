<?php

namespace app\models\product\interfaces;
use PDO;

interface ProductInterface
{
    public function load($data);
    public function getData();
    public function save();
    public function getStatementAndBindValues(PDO $pdo);
}