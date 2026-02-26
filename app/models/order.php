<?php

namespace App\Models;

use App\Config\Database;

class Order {

    public static function create($userId, $total) {

        $db = Database::connect();

        $stmt = $db->prepare(
            "INSERT INTO orders (user_id,total) VALUES (?,?)"
        );

        $stmt->execute([$userId,$total]);

        return $db->lastInsertId();
    }
}