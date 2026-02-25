<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Product {

    public static function all() {

        return Database::connect()
            ->query("SELECT * FROM products")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {

        $stmt = Database::connect()
            ->prepare("SELECT * FROM products WHERE id = ?");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {

        $stmt = Database::connect()
            ->prepare("INSERT INTO products (name,description,price,image,stock)
                       VALUES (?,?,?,?,?)");

        return $stmt->execute([
            $data['name'],
            $data['description'],
            $data['price'],
            $data['image'],
            $data['stock']
        ]);
    }
}