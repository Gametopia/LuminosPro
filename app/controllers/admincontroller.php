<?php

namespace App\Controllers;

use App\Models\Product;

class AdminController
{

    public static function createProduct()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            Product::create($_POST);

            header("Location: products.php");
            exit;
        }
    }
}