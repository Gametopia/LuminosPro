<?php

namespace App\Models;

use App\Config\Database;

class OrderItem {

    public static function create($orderId,$productId,$quantity,$price) {

        $stmt = Database::connect()->prepare(
            "INSERT INTO order_items (order_id,product_id,quantity,price)
             VALUES (?,?,?,?)"
        );

        return $stmt->execute([
            $orderId,
            $productId,
            $quantity,
            $price
        ]);
    }
}