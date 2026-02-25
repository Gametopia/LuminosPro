<?php

namespace App\Controllers;

class CartController {

    public static function add($productId) {

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $_SESSION['cart'][$productId] =
            ($_SESSION['cart'][$productId] ?? 0) + 1;
    }

    public static function clear() {
        unset($_SESSION['cart']);
    }
}