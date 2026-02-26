<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class User {

    public static function create($username, $email, $password) {

        $db = Database::connect();

        $stmt = $db->prepare(
            "INSERT INTO users (username,email,password) VALUES (?,?,?)"
        );

        return $stmt->execute([
            $username,
            $email,
            password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

    public static function findByEmail($email) {

        $db = Database::connect();

        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}